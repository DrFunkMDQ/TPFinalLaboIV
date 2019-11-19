<?php require_once('VerifySessionUser.php'); ?>  

<div class="container-fluid px-5">
    <div class="profileDataSection">
        <div>
            <h2>Personal Information</h2>
        </div>
        <div class="profileData">
            <table class="table table-borderless text-light">
                <tr>
                    <td class="rowLabel">First Name:</td>
                    <td><?php echo ($loggedUser->getUserName()) ?></td>
                </tr>
                <tr>
                    <td class="rowLabel">Last Name:</td>
                    <td><?php echo ($loggedUser->getUserLastName()) ?></td>
                </tr>
                <tr>
                    <td class="rowLabel">Email:</td>
                    <td><?php echo ($loggedUser->getEmail()) ?></td>
                </tr>
                <tr>
                    <td class="rowLabel"> Birthday:</td>
                    <td><?php echo ($loggedUser->getBirthday()) ?></td>
                </tr>
            </table>
        </div>
    </div>    
    <div class="profileTicketsSection">
        <div>
            <h2>Purchase History</h2>
        </div>       
        <table class="table table-borderless table-light">
            <thead>
                <tr class="bg-dark text-light">
                    <th>Purchase ID</th>
                    <th>Purchase Date</th>
                    <th>Purchase Amount</th>
                </tr>
            </thead>
        </table>        
        <div class="accordion" id="accordion">
            <?php foreach($userPurchases as $purchase){
                include(VIEWS_PATH."userPurchaseCard.php");
            }?>
        </div>
    </div>
</div>