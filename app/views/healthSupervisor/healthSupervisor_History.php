<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>HealthSupervisor History</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/healthSupervisor/healthSupervisor_History.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
<div class="content">
    <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
      <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>

                    <div class="patientFile">
                        
                        <h2>Inquiries History(<?php echo $data['totalReadInquiries'] ?>)</h2>
                        <?php foreach($data['readInquiries'] as $readInquiry): ?>
                        <div class="inquiry">
                          <p><img src="<?php echo URLROOT?>/public/img/healthSupervisor/envelope.png" alt=""></p>
                          <p id="idNO"><?php echo $readInquiry->inquiry_ID ?></p>
                          <p><?php echo $readInquiry->name ?></p>
                          <p><?php echo $readInquiry->date ?></p>
                          <input type="checkbox" id="scales" name="scales" checked />
                        </div>
                        <?php endforeach ?>
                        <div class="pagination">
                        <?php if (isset($data['totalPages'])): ?>
                            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                                <a href="<?php echo URLROOT; ?>/healthSupervisor/history/<?php echo $i; ?>" <?php echo ($i == $data['currentPage']) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</body>