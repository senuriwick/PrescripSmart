<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Reports</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/reports.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\general\in_page_navigation.css" />
    <!-- <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/sideMenu_navBar.css" /> -->
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>
        <!-- <div class="container"> -->
            
                <!-- <div class="navBar">
                    <img src="<?php echo URLROOT;?>/public/img/doctor/user.png" alt="user-icon">
                    <p><?php echo $_SESSION['USER_DATA']->username?></p>
                </div> -->
            
            <div class="main">
                <!-- <div class="main-Container"> -->
                <?php include 'top_navigation_panel.php'; ?>

                <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <div class="menu">
        <a href="<?php echo URLROOT; ?>/doctor/viewPrescriptions/<?php echo $data['patient']->patient_ID;?>" id="prescriptions">Prescriptions</a>
        <a href="<?php echo URLROOT; ?>/doctor/viewReports/<?php echo $data['patient']->patient_ID;?>" id="reports">Reports</a>
</div>

                    <div class="patientSearch">
                        <div class="topic">
                            <label>Reports(<?php echo $data['reportsCount'];?>)</label>
                        </div>
                        <div class="prescription-table">
                            <table>
                                <tbody>
                                    <?php foreach($data['reportsData'] as $reportData): ?>
                                    <tr class="clickable-row1" reportid="<?php echo $reportData->report_ID;?>">
                                        <td>
                                            <div class="presDiv" id="presDiv" >
                                                <img src="<?php echo URLROOT;?>/public/img/doctor/description.png" alt="download-icon">
                                                <p><?php echo $reportData->name; ?></p>
                                            </div>
                                        </td>
                                        <td><?php echo $reportData->date_of_report;?></td>
                                        <td></td>
                                    </tr>
                                    <?php endforeach; ?>    
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows1 = document.querySelectorAll("tr.clickable-row1");
            rows1.forEach(row => {
                row.addEventListener("click", () => {
                    var reportid = row.getAttribute('reportid');

                    fetch(`<?php echo URLROOT;?>/doctor/chechRoport?reportid=${reportid}`)
                    .then(response=>{
                        console.log(response);
                        return response.json();
                    })
                    .then(data =>{
                        console.log(data);
                        console.log(data.report);
                        if((data.report)){
                            window.open(`<?php echo URLROOT;?>/doctor/loadReport?reportid=${data.report_ID}`,'_blank')

                        }else{
                            alert("This lab report is not uploaded yet");
                        }
                    })

                    
                });

            });

        });
    </script>
</body>