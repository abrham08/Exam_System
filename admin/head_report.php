<?php

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

function generatePdf($htmlContent, $outputFileName)
{
    // Create a new Dompdf instance
    $dompdf = new Dompdf();

    // Load HTML content into Dompdf
    $dompdf->loadHtml($htmlContent);

    // Set the paper size and orientation (optional)
    $dompdf->setPaper('A4', 'portrait');

    // Render the PDF
    $dompdf->render();

    // Get the generated PDF content
    $pdfContent = $dompdf->output();

    // Determine the operating system's download directory path
    $downloadDirectory = '';

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // Windows
        $downloadDirectory = 'pdf/';
    } else {
        // Linux or other operating systems
        $downloadDirectory = 'pdf';
    }

    // Set the path for saving the PDF file
    $outputFilePath = $downloadDirectory . $outputFileName;

    // Save the PDF file to the server
    file_put_contents($outputFilePath, $pdfContent);

    // Provide a download link to the user
    $downloadLink = '
    <div class="ms-auto">
    <a class="btn btn-primary btn-sm" href="' . $outputFilePath . '" download>Download PDF</a>
</div>

    </div>';

    // Output the download link
    echo $downloadLink;
}


include "dbc.php";
if(isset($_POST['page']))
{
if($_POST['page'] == 'eResult')
	{
		if($_POST['action'] == 'repogen')

		{
             $formatti=$_POST['format'];
             $strm=$_POST['strm'];
             $syear=$_POST['syear'];
             $catego=$_POST['catego'];
             $ename=$_POST['ename'];
             $depart=$_POST['depart'];
             $head=$_POST['head'];
             $mpass = 0;
             $fpass = 0;
             $mfail = 0;
             $ffail = 0;
             $no = 1;
             $tmale = 0;
             $tfemale = 0;
             $allmale = 0;
             $allfemale = 0;

             $hatrifetch=$pdo->prepare('SELECT title, fname, lname FROM account WHERE user_id =:hdeeppid');
             $hatrifetch->bindValue(':hdeeppid',$head);
             $hatrifetch->execute();
             $hatricat=$hatrifetch->fetch(PDO::FETCH_ASSOC);
             $hdepname =$hatricat['title'].' '. $hatricat['fname'].' '.$hatricat['lname']  ??null;

             $atrifetch=$pdo->prepare('SELECT dep_name FROM department WHERE dep_id =:deeppid');
             $atrifetch->bindValue(':deeppid',$depart);
             $atrifetch->execute();
             $atricat=$atrifetch->fetch(PDO::FETCH_ASSOC);
             $depname = $atricat['dep_name'] ??null;

             $satrifetch=$pdo->prepare('SELECT cat_name FROM category WHERE cat_id =:cdeeppid');
             $satrifetch->bindValue(':cdeeppid',$catego);
             $satrifetch->execute();
             $satricat=$satrifetch->fetch(PDO::FETCH_ASSOC);
             $catname = $satricat['cat_name'] ?? null;

             $esatrifetch=$pdo->prepare('SELECT * FROM exam WHERE exam_id =:edeeppid');
             $esatrifetch->bindValue(':edeeppid',$ename);
             $esatrifetch->execute();
             $esatricat=$esatrifetch->fetch(PDO::FETCH_ASSOC);
             $examname = $esatricat['exam_name'] ??null ;
             $examval = $esatricat['exam_value'] ??null ;
            
            if($formatti == 'PDF'){

                $html='';
                $stud='';
                $results='';
                $pass='';
                $fail='';
                $final_result = '';
                $sql = "SELECT * FROM examinee  
                WHERE Department = :depa 
                AND ex_year = :eyear ";
        
                if ($strm != "*") {
                    $sql .= "AND ex_group = :egroup ";
                }
                
                $sql .= "ORDER BY fname ASC";
                


                $sfet = $pdo->prepare($sql);
                $sfet->bindValue(':depa', $depart);
                if ($strm != "*") {
                $sfet->bindValue(':egroup', $strm);
                 }
                $sfet->bindValue(':eyear',$syear);
                $sfet->execute();
                $prof = $sfet->fetchALL(PDO::FETCH_ASSOC);
                $stud= count($prof);


                // Example usage
                $html .= '<html><body>
                <h1 style="text-align:center;">Exam Report</h1>
                <h5>Department: '.$depname  .' </h5>
                <h5>Course: '.$catname .' </h5>
                <h5>Exam Name: '.$examname .' </h5>
                <h5>Exam Value: '.$examval .'%</h5>
                <div class="table table-responsive table-bordered table-striped container" style="text-align: center;">
                    <table style="border-collapse: collapse; border: 1px solid black; padding: 10px;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black; padding: 10px;">No.</th>
                                <th style="border: 1px solid black; padding: 10px;">Course</th>
                                <th style="border: 1px solid black; padding: 10px;">Full Name</th>
                                <th style="border: 1px solid black; padding: 10px;">Category</th>
                                <th style="border: 1px solid black; padding: 10px;">Year</th>
                                <th style="border: 1px solid black; padding: 10px;">Result</th>
                                <th style="border: 1px solid black; padding: 10px;">Decision</th>
                            </tr>
                        </thead>
                        <tbody>';
            
            foreach ($prof as $pf) {
                
                if($pf['gender'] == 'Male'){
                    $allmale++;
                }
                if($pf['gender'] == 'Female'){
                    $allfemale++;
                }

                $fet = $pdo->prepare("SELECT * FROM final_result WHERE exam_id=:eid AND uid=:uiid");
                $fet->bindValue(':eid', $ename);
                $fet->bindValue(':uiid', $pf['uiid']);
                $fet->execute();
                $sarticles = $fet->fetchAll(PDO::FETCH_ASSOC);
                
                $results = (int)$results + count($sarticles);
                foreach ($sarticles as $art) {




                     if(count($sarticles ) > 0 && $pf['gender'] == 'Male'){
                        $tmale++;
                     }
                     if(count($sarticles ) > 0 && $pf['gender'] == 'Female'){
                        $tfemale++;
                     }
                    if ($pf['Department'] == $depart) {
                        $dfetdch = $pdo->prepare('SELECT cat_name FROM category WHERE cat_id=:catimp');
                        $dfetdch->bindValue(':catimp', $catego);
                        $dfetdch->execute();
                        $dcatdep = $dfetdch->fetch(PDO::FETCH_ASSOC);
            
                        $html .= '<tr>
                             <td style="border: 1px solid black; padding: 10px;">' . $no . '</td>
                            <td style="border: 1px solid black; padding: 10px;">' . $dcatdep['cat_name'] . '</td>
                            <td style="border: 1px solid black; padding: 10px;">' . $pf['fname'] . ' ' . $pf['lname'] .' ' . $pf['gname'].' </td>
                            <td style="border: 1px solid black; padding: 10px;">' . $pf['ex_group'] .'</td>
                            <td style="border: 1px solid black; padding: 10px;">' . $pf['ex_year'] .'</td>
                            <td style="border: 1px solid black; padding: 10px;">' . $art['result'] .'%</td>
                            <td style="border: 1px solid black; padding: 10px;">';
            
                        if ($art['result'] > 50) {
                            if($pf['gender'] == 'Male'){
                                $mpass++;
                            }
                            if($pf['gender'] == 'Female'){
                                $fpass++;
                            }
                            $html .= '<div>P</div>';
                            $pass = (int)$pass + 1;
                        } else {
                            if($pf['gender'] == 'Male'){
                                $mfail++;
                            }
                            if($pf['gender'] == 'Female'){
                                $ffail++;
                            }
                            $html .= '<div>F</div>';
                            $fail = (int)$fail + 1;
                        }
                       

                        $html .= '</td>
                        </tr>';
                    }
                }
                if(count($sarticles ) > 0){
                    $no++; 
                }
                
            }

            if($results == ''){
                $results=0;
            }
            if($stud == ''){
                $stud=0;
            }
            if($pass == ''){
                $pass=0;
            }
            if($fail == ''){
                $fail=0;
            }

            
            $html .= '</tbody>
                    </table>
                </div>
                <h1>General Report</h1>
                <table style="border-collapse: collapse; border: 1px solid black; padding: 10px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 10px;">Pass</th>
                        <th style="border: 1px solid black; padding: 10px;">Fail</th>
                        <th style="border: 1px solid black; padding: 10px;">Total Participants</th>
                        <th style="border: 1px solid black; padding: 10px;">Total Students</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td style="border: 1px solid black; padding: 10px;">'.$pass.'</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$fail.'</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$results.'</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$stud.'</td>

                    </tr>
                    <tr>';
                    if($results !=0){
                        $final_result = $pass/$results;
                        $final_result = $final_result * 100;
 
                    }
          $html .= '<td colspan="4" style="border: 1px solid black; padding: 10px;">'.$final_result.'% Student Passed </td></tr>
                
                </tbody>
                </table>

                <h1>Gender Report</h1>
                <table style="border-collapse: collapse; border: 1px solid black; padding: 10px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 10px;">Sex</th>
                        <th style="border: 1px solid black; padding: 10px;">Pass</th>
                        <th style="border: 1px solid black; padding: 10px;">Fail</th>
                        <th style="border: 1px solid black; padding: 10px;">Total Participants</th>
                        <th style="border: 1px solid black; padding: 10px;">Total Students</th>
                        <th style="border: 1px solid black; padding: 10px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td style="border: 1px solid black; padding: 10px;">Male</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$mpass.'</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$mfail.'</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$tmale.'</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$allmale.'</td>

                   
                    ';
                    if($tmale !=0){
                        $mfinal_result = $mpass/$tmale;
                        $mfinal_result = $mfinal_result * 100;
 
                    }
          $html .= '<td  style="border: 1px solid black; padding: 10px;">'.$mfinal_result.'% male Passed </td>
                   </tr>

                   <tr>
                    <td style="border: 1px solid black; padding: 10px;">Female</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$fpass.'</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$ffail.'</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$tfemale.'</td>
                    <td style="border: 1px solid black; padding: 10px;">'.$allfemale.'</td>

                    
                    ';
                    if($tfemale !=0){
                        $fmfinal_result = $fpass/$tfemale;
                        $fmfinal_result = $fmfinal_result * 100;
 
                    }
          $html .= '<td  style="border: 1px solid black; padding: 10px;">'.$fmfinal_result.'% female Passed </td>
                   </tr>

                </tbody>
                </table>
                
                
                <h5>Generated by: '.$hdepname.'</h5>
                <h5>Date: '.date('d-m-y  h:i').'</h5>';

                 
          $html .= ' </body></html>';

               echo'<div style="display: flex; justify-content: space-between;">
               <div  class="text-start fs-5">'.$results.' '.' results found</div>';
            
                $outputFileName = 'New_Report.pdf';
              if($results && $stud !=0){
                generatePdf($html, $outputFileName);
              }

            }
             
             


        }
    
    }
}












?>
