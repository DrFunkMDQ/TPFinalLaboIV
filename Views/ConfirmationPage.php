<div class="container-fluid px-5">
    <table class="table table-borderless ConfirmationSection">
        <form>
            <div>
                <tr class="my-2 rounded bg-dark text-uppercase text-light">
                    <td colspan="2">Thanks for Buying!</td>
                </tr>
            </div>
            <div>
                <tr>
                    <td class="bg-light col-md-2" colspan="2">
                        An email has been sent to you with the QR codes of your tickets
                    </td>
                </tr>
                <tr>
                    <td class="bg-light btn-col">
                        <button class="btn btn-primary" type="submit" onclick="this.form.action = '<?php echo FRONT_ROOT ?>User/ShowProfileView'">Back to Profile</button>
                    </td>
                </tr>
            </div>
        </form>
    </table>
</div>