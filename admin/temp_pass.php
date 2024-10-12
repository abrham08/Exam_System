<?php
session_start();
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

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
if (isset( $_SESSION['huid'])) {
if(isset($_POST['page']))
{
if($_POST['page'] == 'eResult')
	{
		if($_POST['action'] == 'repogen')

		{
             $formatti=$_POST['format'];
             $strm=$_POST['strm'];
             $syear=$_POST['syear'];
             $depart=$_POST['depart'];
             $head=$_POST['head'];

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
                <h1 style="text-align:center;">Account Report</h1>
                <h5>Department: '.$depname  .' </h5>
                <div class="table table-responsive table-bordered table-striped container" style="text-align: center;">
                    <table style="border-collapse: collapse; border: 1px solid black; padding: 10px;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black; padding: 10px;">Full Name</th>
                                <th style="border: 1px solid black; padding: 10px;">Category</th>
                                <th style="border: 1px solid black; padding: 10px;">Year</th>
                                <th style="border: 1px solid black; padding: 10px;">User Name</th>
                                <th style="border: 1px solid black; padding: 10px;">Password</th>
                            </tr>
                        </thead>
                        <tbody>';
            
            foreach ($prof as $pf) {

               


               
                    if ($pf['Department'] == $depart) {
                        $html .= '<tr>
                            <td style="border: 1px solid black; padding: 10px;">' . $pf['fname'] . ' ' . $pf['lname'] .' ' . $pf['gname'].' </td>
                            <td style="border: 1px solid black; padding: 10px;">' . $pf['ex_group'] .'</td>
                            <td style="border: 1px solid black; padding: 10px;">' . $pf['ex_year'] .'</td>
                            <td style="border: 1px solid black; padding: 10px;">' . $pf['user_name'] .'</td>
                            <td style="border: 1px solid black; padding: 10px;">' . $pf['rpass'] .'</td>
                        </tr>';
                    }
                
            }


            if($stud == ''){
                $stud=0;
            }

            
            $html .= '</tbody>
                    </table>
                </div>
               
     
                
                </tbody>
                </table>
                
                
                <h5>Generated by: '.$hdepname.'</h5>
                <h5>Date: '.date('d-m-y  h:i').'</h5>';

                 
          $html .= ' </body></html>';

               echo'<div style="display: flex; justify-content: space-between;">
               <div  class="text-start fs-5">'.$stud.' '.' students found</div>';
            
                $outputFileName = 'New_Password.pdf';
              if( $stud !=0){
                generatePdf($html, $outputFileName);
              }

            }
             
             


        }
    
    }
}

}else{
    header("Location: session.php");
    exit();
  }










?>
