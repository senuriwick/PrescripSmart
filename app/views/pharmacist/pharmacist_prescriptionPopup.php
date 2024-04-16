<div id="popup">
<div class="grid-container">
                                    <img id="qr" src="<?php echo URLROOT?>/app/views/pharmacist/images/qr-code.png" alt="">
                                
                                    <h2>CONFIDENTIAL PRESCRIPTION</h2>
                                    <img onclick="closePopup()" class="close" src="<?php echo URLROOT?>/app/views/pharmacist/images/close-button.png" alt="">
                            
                                    
                                </div>
                                <div class="grid-container">
                                    <?php $patient = $data['patient'] ?>
                                    <p>Reception ID: <span><?php echo $patient -> reception_id ?></span></p>
                                    <p class="patient">patient: <span><?php echo $_GET['patient_name']; ?></span></p>
                                </div>
                                <div class="grid-container">
                                    <p>Pres. Date & Time: <span><?php echo $patient -> prescribing_date ?></span></p>
                                    <p id="age">Age: <span><?php echo $_GET['patient_age']; ?></span>Yrs</p>
                                </div>
                                <div class="grid-container">
                                    <p>Referred by: <span><?php echo $patient -> prescribing_doctor ?></span></p>
                                </div>
                                <div class="diagnosis1">
                                    
                                    <div class="diagnosis">
                                        <p class="pres-header">Diagnosis</p>
                                        <?php foreach ($data['diagnoses'] as $diagnosis): ?>
                                        <p><?php echo $diagnosis -> diagnosis_description ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                    

                                    <div class="diagnosis">
                                        <p class="pres-header">Medication</p>
                                        
                                        <div class="med">  
                                            <p>Name</p> 
                                            <p>Dosage</p>
                                            <p>Remarks</p>
                                        </div>  
                                        
                                        <?php foreach ($data['medications'] as $medication): ?>
                                        <div class="med">
                                            <p><?php echo $medication -> name ?></p>
                                            <p><?php echo $medication -> dosage ?></p>
                                            <p><?php echo $medication -> remarks ?></p>
                                        </div>
                                        <?php endforeach; ?>
                                    
                                    </div>
                                    <div class="diagnosis">
                                        <p class="pres-header">Lab Tests</p>
                                        <div class="med">  
                                            <p>Name</p> 
                                            <p>Remarks</p>
                                        </div>
                                        <?php foreach ($data['labtests'] as $labtest): ?>
                                        <div class="med">
                                            <p><?php echo $labtest -> name ?></p>
                                            <p><?php echo $labtest -> remarks ?></p>   
                                        </div>
                                        <?php endforeach; ?>
  
                                    </div>
                                    <p>
                                        (For view purposes only)
                                    </p>
                                    
                                </div>
</div>

