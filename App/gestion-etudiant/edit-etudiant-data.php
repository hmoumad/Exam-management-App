 <?php
 require('../includes/connection.php');
 session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
 if(isset($_GET['codeEtudiant'])){
    $codeEtudiant = $_GET['codeEtudiant'];
    $codeEtudiant = $codeEtudiant . "%";
    $query ="SELECT * FROM etudiant WHERE COD_ETD LIKE '$codeEtudiant' OR NOM like'$codeEtudiant' OR PRENOM LIKE '$codeEtudiant' OR FILIERE like '$codeEtudiant' limit 100";
    $result =mysqli_query($conn,$query);
    $rowcount = mysqli_num_rows($result);
}


?>


<?php 
if( $rowcount != 0){
    ?>
    <table class="table">
        <thead class="table-dark">
            <tr>

                <th>CODE APOJEE </th>
                <th>CIN</th>
                <th>CNE</th>
                <th>NOM </th>
                <th>PRENOM</th>
                <th>MODULE</th>
                <th>FILIERE </th>
                <th>SEMESTRE</th>
                <th>SECTION</th>
                <th>MODIFIE </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>

                        <td name="COD_ETD"><?php echo $row['COD_ETD']; ?></td>
                        <td name="CIN"><?php echo $row['CIN']; ?></td>
                        <td name="CNE"><?php echo $row['CNE']; ?></td>
                        <td name="NOM"><?php echo $row['NOM']; ?></td>
                        <td name="PRENOM"><?php echo $row['PRENOM']; ?></td>
                        <td name="MODULE"><?php echo $row['MODULE']; ?></td>
                        <td name="FILIERE"><?php echo $row['FILIERE']; ?></td>
                        <td name="SEMESTRE"><?php echo $row['SEMESTRE']; ?></td>
                        <td name="SECTION"><?php echo $row['SECTION']; ?></td>
                        <td>



                            <button id=  "<?php echo $row['id']; ?>" class="editbutton" name="clicked" onclick="edit(this.id)">edit</button>


                        </td>
                    </tr>





                <?php
            }

            ?>
        </tbody>
    </table>




    <?php
}
?>