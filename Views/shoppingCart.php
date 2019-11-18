<?php
if(!empty($_SESSION["Shopping-Cart-Object"])){
    $list = $_SESSION["Shopping-Cart-Object"];
    foreach ($list as $key => $show) {
?>
        <form>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <!-- Aplicadas en las filas -->
                        <th class="active">Show</th>
                        <th class="success">Date</th>
                        <th class="warning">ShowRoom</th>
                        <th class="danger">Time</th>

                        <!-- Aplicadas en las celdas (<td> o <th>) -->
                        <tr>
                            <td class="active"><?php echo $show->getMovie(); ?></td>
                            <td class="success"><?php echo $show->getDate(); ?></td>
                            <td class="warning"><?php echo $show->getShowRoom(); ?></td>
                            <td class="danger"><?php echo $show->getTime(); ?></td>
                        </tr>
                    </tbody>    
                </table>
            </div>            
            <button class="btn btn-primary" type="submit" name="key" class="btn btn-light" value="<?php echo ($key); ?>" onclick="this.form.action = '<?php echo FRONT_ROOT?>Purchase/RemoveItemCart'">Remove</button>
        </form>
<?php } ?>
<form>
 <button class="btn btn-primary" type="submit" name="key" class="btn btn-light"  onclick="this.form.action = '<?php echo FRONT_ROOT?>Purchase/Add'">Buy</button>
</form>
 <?php }
else{
    echo'<script type="text/javascript">
    alert("Empty Cart!");
    window.location.href="http://localhost/TPFinalLaboIV/";                
    </script>';     
}?>



