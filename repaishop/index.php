<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Shop</title>
    <link rel="stylesheet" href="CSS/index.css?v=<?php echo time(); ?>">
    <script src="JS/index.js?v=<?php echo time(); ?>"></script>
    <script src="https://kit.fontawesome.com/10720aacd2.js" crossorigin="anonymous"></script>
    <script src="html2pdf.bundle.min.js"></script>
</head>
<body>


    <!-- PHP Codes -->
    <?php
        // Connecting to DB
        $conn = mysqli_connect('busrvdovjzql8nhy3fez-mysql.services.clever-cloud.com', 'uo2o0c3c25onn1in', '85YHuzICKjtxZ2h5xkAp', 'busrvdovjzql8nhy3fez');
        if(!$conn)
            die('Could not connect: ' . mysqli_error());

        
        // ----------------Adding---------------------
        // Job Order Insert
        if (isset($_POST["add-joborder-submit"])){
            $add1 = $_POST['name'];
            $add2 = $_POST['date'];
            $add3 = $_POST['address'];
            $add4 = $_POST['number'];
            $add5 = $_POST['device_type'];
            $add6 = $_POST['accessories'];
            $add7 = $_POST['model_number'];
            $add8 = $_POST['brand_name'];
            $add9 = $_POST['serial_number'];
            $add10 = $_POST['complain'];
            $add11 = $_POST['warranty'];
            $add12 = $_POST['type_of_repair'];
            $add13 = $_POST['Status'];

            $sql = "INSERT INTO joborder (Name, Date, Address, Number, Device_Type, Accessories, Model_Number, Brand_Name, Serial_Number, Complain, Warranty, Type_of_Repair, Status) VALUES ('$add1', '$add2', '$add3', '$add4', '$add5', '$add6', '$add7', '$add8', '$add9', '$add10', '$add11', '$add12' , '$add13')";

            $conn->query($sql);
            
        }

        // Job Order Update
        if (isset($_POST["add-joborder-final-submit"])){
            $add1 = $_POST["Findings"];
            $add2 = $_POST["Materials"];
            $add3 = $_POST["Check-up"];
            $add4 = $_POST["Labor"];
            $add5 = $_POST["Total"];
            $add6 = $_POST["Technician"];
            $add7 = $_POST["Status"];
            $add8 = $_POST["jon"];
            $add9 = $_POST["Warranty_exp"];
            $add10 = $_POST["type"];
            $add11 = $_POST["name"];

            $data1 = $_POST["material_data"];
            $data2 = $_POST["quantity_data"];
            $data3 = $_POST["credit_data"];
            $data4 = $_POST["number_data"];
            

            // turn data into array 
            $arr = explode("---",$data1);
            $quantities = explode("---",$data2);
            $credits = explode("---",$data3);
            $numbers = explode("---",$data4);

            $str = "INSERT INTO inventory_logs(Date, Credit, Product_Name, Price, Quantity, Product_Number) VALUES (current_timestamp(),";
            for($i = 1; $i<=count($arr);$i++){
                $temp = $arr[$i-1];
                    if($i%5 == 0){
                        $str .= "'$temp')";
                        $conn->query($str);
                        $str = "INSERT INTO inventory_logs(Date, Credit, Product_Name, Price, Quantity, Product_Number) VALUES (current_timestamp(),";
                        continue;
                    }
                $str .= "'$temp',";
            }

            for($i = 0; $i<count($quantities);$i++){
                $quantity = intval($quantities[$i]) - intval($credits[$i]);
                $no = intval($numbers[$i]);
                
                $conn->query("UPDATE inventory SET Quantity = '$quantity' WHERE Product_Number = '$no'");
            }


            $conn->query("UPDATE joborder SET Findings = '$add1', Materials = '$add2', Check_up = '$add3', Labor = '$add4', Total = '$add5', Technician = '$add6', Warranty_exp = '$add9', Status = '$add7' WHERE JON = '$add8'");

            $conn->query("INSERT INTO schedules VALUES ('$add8', '$add11', '$add10', '$add9')");

        }

        // Inventory Insert
        if(isset($_POST["add-inventory-submit"])){
            $add1 = $_POST["Product_Number"];
            $add2 = $_POST["Pro_Name"];
            $add3 = $_POST["Price"];
            $add4 = $_POST["Quantity"];

            $sql = "INSERT INTO inventory VALUES ('$add1','$add2','$add3','$add4')";

            $conn->query($sql);
        }

        // Inventory Update
        if(isset($_POST["update-inventory-submit"])){
            $add1 = $_POST["UProduct_Number"];
            $add2 = $_POST["UPro_Name"];
            $add3 = $_POST["UPrice"];
            $add4 = $_POST["UQuantity"];
            
            $update1 = $_POST["logName"];
            $update2 = $_POST["logNumber"];
            $update3 = $_POST["logDebit"];
            $update4 = $_POST["logCredit"];
            $update5 = $_POST["logPrice"];
            $update6 = $_POST["logQuantity"];

            $conn->query("INSERT INTO inventory_logs VALUES (current_timestamp(),'$update1', '$update2', '$update3', '$update4', '$update5', '$update6')");

            $conn->query("UPDATE inventory SET Name = '$add2', Price = '$add3', Quantity = '$add4' WHERE Product_Number = '$add1'");
            
        }

        // Employee Insert
        if(isset($_POST["add-employee-submit"])){
            $add1 = $_POST["Emp_Name"];
            $add2 = $_POST["TIN"];
            $add3 = $_POST["SSS"];
            $add4 = $_POST["PAGIBIG"];
            $add5 = $_POST["PHILHEALTH"];

            $sql = "INSERT INTO employee VALUES ('$add1','$add2','$add3','$add4','$add5')";

            $conn->query($sql);
        }

        // Employee Insert
        if(isset($_POST["update-employee-submit"])){
            $add1 = $_POST["uEmp_Name"];
            $add2 = $_POST["uTIN"];
            $add3 = $_POST["uSSS"];
            $add4 = $_POST["uPAGIBIG"];
            $add5 = $_POST["uPHILHEALTH"];
            $add6 = $_POST["Emp_Name"];

            $sql = "UPDATE employee SET Name = '$add1', TIN = '$add2', SSS = '$add3', PAGIBIG = '$add4', PHILHEALTH = '$add5' WHERE Name = '$add6' ";

            $conn->query($sql);
        }


        // Installation Insert
        if (isset($_POST["add-installation-submit"])){
            $add1 = $_POST['ins-name'];
            $add2 = $_POST['ins-date'];
            $add3 = $_POST['ins-address'];
            $add4 = $_POST['ins-number'];
            $add5 = $_POST['ins-brand-name'];
            $add6 = $_POST['ins-model-name'];
            $add7 = $_POST['ins-model-number'];
            $add8 = $_POST['ins-serial-number'];
            $add9 = $_POST['ins-labor'];
            $add10 = $_POST['ins-total'];

            $sql = "INSERT INTO installation VALUES (null,'$add1','$add2','$add3','$add4','$add5','$add6','$add7','$add8','$add9','$add10', null)";

            $conn->query($sql);
        }

        // Installation update
        if (isset($_POST["update-installation-submit"])){
            $add1 = $_POST['up-name'];
            $add2 = $_POST['up-date'];
            $add3 = $_POST['up-address'];
            $add4 = $_POST['up-number'];
            $add5 = $_POST['up-brand-name'];
            $add6 = $_POST['up-model-name'];
            $add7 = $_POST['up-model-number'];
            $add8 = $_POST['up-serial-number'];
            $add9 = $_POST['up-labor'];
            $add10 = $_POST['up-total'];
            $add_id = $_POST['order-id'];

            $sql = "UPDATE installation SET Name = '$add1', Date = '$add2', Address = '$add3', Number = '$add4', Brand_Name = '$add5', Model_Name = '$add6',Model_Number = '$add7', Serial_Number = '$add8', Labor = '$add9', Total = '$add10' WHERE Order_Number = '$add_id' ";

            $conn->query($sql);
        }
    ?>


    <!----------------------- START OF HTML CODES---------------- -->
    <!-- wrapper -->
    <div class="wrapper">

        <!-- FORMS -->
        <div class="back-filter" id="forms" style="display: none;">

            <!-- -------------ACTUAL FORMS---------------------- -->

            <!-- Employee -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display: none;">
                <input type="text" id="type" value="Repair" name="type">
                <input type="number" id="jon" value="" name="jon">
                <input type="text" id="add-joborder1" value="" name="name">
                <input type="text" id="add-joborder2" value="" name="date">
                <input type="text" id="add-joborder3" value="" name="address">
                <input type="number" id="add-joborder4" value="" name="number">
                <input type="text" id="add-joborder5" value="" name="device_type"> 
                <input type="text" id="add-joborder6" value="" name="accessories">
                <input type="number" id="add-joborder7" value="" name="model_number">
                <input type="text" id="add-joborder8" value="" name="brand_name"> 
                <input type="number" id="add-joborder9" value="" name="serial_number">
                <input type="text" id="add-joborder10" value="" name="complain">
                <input type="text" id="add-joborder11" value="" name="warranty">
                <input type="text" id="add-joborder12" value="" name="type_of_repair">
                <input type="text" id="add-joborder13" value="" name="Findings">
                <input type="hidden" id="add-joborder14" value="" name="Materials">
                <input type="number" id="add-joborder15" value="" name="Check-up">
                <input type="number" id="add-joborder16" value="" name="Labor">
                <input type="number" id="add-joborder17" value="" name="Total" >
                <input type="text" id="add-joborder18" value="" name="Technician" >
                <input type="text" id="add-joborder19" value="" name="Warranty_exp" >
                <input type="text" id="add-joborder20" value="" name="Status">

                <input type="hidden" name="material_data" id="material_data">
                <input type="hidden" name="quantity_data" id="quantity_data">
                <input type="hidden" name="credit_data" id="credit_data">
                <input type="hidden" name="number_data" id="number_data">
                
                <button type="submit" id="add-joborder-submit" name="add-joborder-submit"></button>
                <button type="submit" id="add-joborder-final-submit" name="add-joborder-final-submit"></button>
            </form>

            <!-- Inventory -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display: none;">
                <input type="number" id="add-inventory1" name="Product_Number">
                <input type="text" id="add-inventory2" name="Pro_Name">
                <input type="number" id="add-inventory3" name="Price">
                <input type="number" id="add-inventory4" name="Quantity">

                <input type="number" id="update-inventory1" name="UProduct_Number">
                <input type="text" id="update-inventory2" name="UPro_Name">
                <input type="number" id="update-inventory3" name="UPrice">
                <input type="number" id="update-inventory4" name="UQuantity">

                <input type="number" name="logNumber" id="log1" class="log">
                <input type="text" name="logName" id="log0" class="log">
                <input type="number" name="logDebit" id="log2" class="log">
                <input type="number" name="logCredit" id="log3" class="log">
                <input type="number" name="logPrice" id="log4" class="log">
                <input type="number" name="logQuantity" id="log5" class="log">

                <button type="submit" id="add-inventory-submit" name="add-inventory-submit"></button>
                <button type="submit" id="update-inventory-submit" name="update-inventory-submit"></button>
            </form>

            <!-- Logs -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display: none;">
                

                <button type="submit" id="log-submit" name="log-submit"></button>
            </form>

            <!-- Employee -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display: none;">
                <input type="text" id="add-employee1" value="" name="Emp_Name">
                <input type="number" id="add-employee2" value="" name="TIN">
                <input type="number" id="add-employee3" value="" name="SSS">
                <input type="number" id="add-employee4" value="" name="PAGIBIG">
                <input type="number" id="add-employee5" value="" name="PHILHEALTH">

                <input type="text" id="update-employee1" value="" name="uEmp_Name">
                <input type="number" id="update-employee2" value="" name="uTIN">
                <input type="number" id="update-employee3" value="" name="uSSS">
                <input type="number" id="update-employee4" value="" name="uPAGIBIG">
                <input type="number" id="update-employee5" value="" name="uPHILHEALTH">

                <button type="submit" id="add-employee-submit" name="add-employee-submit"></button>
                <button type="submit" id="update-employee-submit" name="update-employee-submit"></button>
            </form>

            <!---------------INSTALLATION ACTUAL FORM-------------->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display: none;">
              <input type="text" id="add-installation1" name="ins-name">
              <input type="text" id="add-installation2" name="ins-date">
              <input type="text" id="add-installation3" name="ins-address">
              <input type="number" id="add-installation4" name="ins-number">
              <input type="text" id="add-installation5" name="ins-brand-name">
              <input type="text" id="add-installation6" name="ins-model-name">
              <input type="number" id="add-installation7" name="ins-model-number">
              <input type="number" id="add-installation8" name="ins-serial-number">
              <input type="number" id="add-installation9" name="ins-labor">
              <input type="number" id="add-installation10" name="ins-total">

              <input type="text" id="update-installation1" name="up-name">
              <input type="text" id="update-installation2" name="up-date">
              <input type="text" id="update-installation3" name="up-address">
              <input type="number" id="update-installation4" name="up-number">
              <input type="text" id="update-installation5" name="up-brand-name">
              <input type="text" id="update-installation6" name="up-model-name">
              <input type="number" id="update-installation7" name="up-model-number">
              <input type="number" id="update-installation8" name="up-serial-number">
              <input type="number" id="update-installation9" name="up-labor">
              <input type="number" id="update-installation10" name="up-total">
              <input type="number" id="update-installation11" name="order-id">

              <button type="submit" id="add-installation-submit" name="add-installation-submit"></button>
              <button type="submit" id="update-installation-submit" name="update-installation-submit"></button>
            </form>
            


            <!---=-=--=--=-=---=-=--=-=-Official Reciept=-=-=-=-=--=-=--->
            <div class="add-joborder official-reciept" id="official-reciept-div" style="display: none;">
                <div class="back-button" onclick="closer2('forms','official-reciept-div')">
                    <img src="resources/back_icon.png" alt="">
                </div>
                <img src="resources/document-download-icon.png" alt="" class="download-button" onclick="downloadDocument()">

                <div  id="official-reciept" >
                    <div class="heading" id="reciept-heading">
                        <img src="resources/logo.png" alt="">
                        <div class="text">
                            <h4>Roll Electornics</h4>
                        <p>Vinzon's Ave, Daet, Camarines Norte <br> 054-885-0659 / 0995-511-6300 / 0999-734-6666</p>
                        </div>
                    </div>
                    <div class="heading" id="reciept-heading2">
                        <h5>Job Order</h5>
                        <div id="reciept-jon">
                            No:. 
                            <div class="reciept-input" id="jon-input"></div>
                        </div>
                        
                    </div>
                    <img class="wave" src="resources/wave1.png" alt="wave">

                    <!-- <div class="input-section"> -->
                        <div class="input-section">
                            <section class="section">
                                <i class="far fa-user"></i>
                                <div id="RI1" class="reciept-input"></div>
                                <i class="far fa-calendar"></i>
                                <div id="RI2" class="reciept-input"></div>
                            </section>
                            <section>    
                                <i class="fas fa-map-marker-alt"></i>
                                <div id="RI3" class="reciept-input"></div>
                                <i class="fas fa-sim-card"></i>
                                <div id="RI4" class="reciept-input"></div>
                            </section>
                            <section>
                                <i class="fas fa-plug"></i>
                                <div id="RI5" class="reciept-input"></div>
                                <i class="fas fa-briefcase"></i>
                                <div id="RI6" class="reciept-input"></div>
                            </section>
                            <section>
                                <i class="fas fa-arrow-circle-right"></i>
                                <div id="RI7" class="reciept-input"></div>
                                <i class="fas fa-arrow-circle-right"></i>
                                <div id="RI8" class="reciept-input"></div>
                            </section>
                            <section>
                                <i class="fas fa-arrow-circle-right"></i>
                                <div id="RI9" class="reciept-input"></div>
                                <i class="fas fa-arrow-circle-right"></i>
                                <div id="RI10" class="reciept-input"></div>
                            </section>
                            <section>
                                <label for="final-input11">Warranty</label>
                                <div id="RI11" class="reciept-input"></div>
                                <label for="final-input12">Type of Repair</label>
                                <div id="RI12" class="reciept-input"></div>
                            </section>
                            <hr style="width: 80%; margin-top: 20px; border-width: 2px;">

                            <section>
                                <i class="fas fa-search"></i>
                                <div id="RI13" class="reciept-input"></div>
                            </section>

                            <section class="reciept-input reciept-table" style="border: none;">
                                <table id="material-table">
                                </table>
                            </section>
                            
                            <section class="reciept-bottom">
                                <h3>Checkup</h4>
                                <div id="RI14" class="reciept-input"></div>
                            </section>
                            <section class="reciept-bottom">
                                <h3>Labor</h4>
                                <div id="RI15" class="reciept-input"></div>
                            </section>
                            <section class="reciept-bottom">
                                <h3>Total</h4>
                                <div id="RI16" class="reciept-input"></div>
                            </section>
                            <section>
                                <h3>Technician</h3>
                                <div id="RI17" class="reciept-input"></div>
                            </section>
                            <section>
                                <h3>Warranty Exp.</h3>
                                <div id="RI18" class="reciept-input"></div>
                            </section>
                        </div>
                        <section id="sketch-section">
                            <div id="sketch">
                                
                            </div>
                        </section>
                </div>
            </div>
            


            <!----------------Final Job Order Add Form------------------->
            <div class="add-joborder add-joborder-final" id="add-joborder-final" style="display: none;">
                <div class="back-button" onclick="closer('forms','add-joborder-final')">
                    <img src="resources/back_icon.png" alt="">
                </div>
                <div class="heading">
                    <div class="text">
                        <h4>Final Job Order</h4>
                    <p>Fill in Information Needed</p>
                    </div>
                    <img src="resources/logo.png" alt="">
                </div>
                <img class="wave" src="resources/wave1.png" alt="wave">
                <!-- <div class="input-section"> -->
                    <div class="input-section">
                        <section>
                            <i class="far fa-user"></i>
                            <input type="text" placeholder="Name" id="final-input1" class="final-inputfield" readonly>
                            <i class="far fa-calendar"></i>
                            <input type="date" placeholder="Date" id="final-input2" class="final-inputfield" readonly>
                        </section>
                        <section>
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" placeholder="Address" id="final-input3" class="final-inputfield" readonly>
                            <i class="fas fa-sim-card"></i>
                            <input type="number" placeholder="Number" id="final-input4" class="final-inputfield" readonly>
                        </section>
                        <section>
                            <input type="text" name="device" id="final-input5" class="final-inputfield">
                            <i class="fas fa-briefcase"></i>
                            <input type="text" placeholder="Accessories" id="final-input6" class="final-inputfield" readonly>
                        </section>
                        <section>
                            <i class="fas fa-arrow-circle-right"></i>
                            <input type="number" placeholder="Model Number" id="final-input7" class="final-inputfield" readonly>
                            <i class="fas fa-arrow-circle-right"></i>
                            <input type="text" placeholder="Brand Name" id="final-input8" class="final-inputfield" readonly>
                        </section>
                        <section>
                            <i class="fas fa-arrow-circle-right"></i>
                            <input type="number" placeholder="Serial Number" id="final-input9" class="final-inputfield" readonly>
                            <i class="fas fa-arrow-circle-right"></i>
                            <input type="text" placeholder="Complain" id="final-input10" class="final-inputfield" readonly>
                        </section>
                        <div class="bottom">
                            <div>
                                <label for="">Warranty</label><br>
                                <select id="final-warranty" class="input11 final-inputfield" disabled>
                                    <option value="" disabled selected>Select One</option>
                                    <option value="In">In</option>
                                    <option value="Out">Out</option>
                                    <option value="Shop">Shop</option>
                                </select>
                            </div>
                            <div>
                                <label for="">Type of Repair</label><br>
                                <select name="repair" id="final-repair" class="input12 final-inputfield" disabled>
                                    <option value="" disabled selected>Select One</option>
                                    <option value="Shop">Shop</option>
                                    <option value="Field">Field</option>
                                    <option value="Dealer">Dealer</option>
                                </select>
                            </div>
                        </div>
                        <hr style="width: 80%; margin-top: 20px; border-width: 2px;">


                        <!-- Final Inputs -->
                        <section>
                            <i class="fas fa-search"></i>
                            <span class="error" id="final-error1" onclick="popoff(this)">This field is requred</span>
                            <input type="text" placeholder="Findings/Remarks..." id="final-input13" class="final-inputs">
                        </section>

                        <section id="bottom-table">
                            <div class="final-table" id="FT1">Quantity</div>
                            <div class="final-table" id="FT2">Materials</div>
                            <div class="final-table" id="FT3">Price</div>
                        </section>

                        <section class="final-inputs">
                            <div id="materials0" class="materials">
                                
                                <input type="number" id="FS1" class="final-select credit_data materials_select" placeholder="Quantity">

                                <select name="" id="FS2" class="final-select materials_select" onchange="getPrice(this)">
                                    <option value="" disabled selected>Select One...</option>
                                    <?php 
                                        $sql = "SELECT * FROM inventory";
                                        $result = $conn->query($sql);

                                        if($result->num_rows > 0){
                                            $i = 0;
                                                while($row = $result->fetch_assoc()){
                                                    echo '<option value="' . $row["Name"] . '">'. $row["Name"] .'</option>';
                                                    $i++;
                                                }
                                        }
                                    ?> 
                                </select>
                                
                                <select name="" class="price-list" style="display: none;">
                                    <?php 
                                        $sql = "SELECT * FROM inventory";
                                        $result = $conn->query($sql);

                                        if($result->num_rows > 0){
                                            $i = 0;
                                                while($row = $result->fetch_assoc()){
                                                    echo '<option value="' . $row["Price"] . '">'. $row["Price"] .'</option>';
                                                    $i++;
                                                }
                                        }
                                    ?> 
                                </select>

                                <input type="number" name="" id="FS3" class="final-select sum-price materials_select" readonly>
                                
                                <!-- hidden -->
                                <select name="" id="FS4" class="final-select quantity_data" style="display: none;">
                                    <?php 
                                        $sql = "SELECT * FROM inventory";
                                        $result = $conn->query($sql);

                                        if($result->num_rows > 0){
                                            $i = 0;
                                                while($row = $result->fetch_assoc()){
                                                    echo '<option value="' . $row["Quantity"] . '">'. $row["Quantity"] .'</option>';
                                                    $i++;
                                                }
                                        }
                                    ?> 
                                </select>
                                <select name="" id="FS5" class="final-select number_data" style="display: none;">
                                    <?php 
                                        $sql = "SELECT * FROM inventory";
                                        $result = $conn->query($sql);

                                        if($result->num_rows > 0){
                                            $i = 0;
                                                while($row = $result->fetch_assoc()){
                                                    echo '<option value="' . $row["Product_Number"] . '">'. $row["Product_Number"] .'</option>';
                                                    $i++;
                                                }
                                        }
                                    ?> 
                                </select>
                            </div>
                        </section>
                        <section style="margin-top: 0;">
                            <i class="fas fa-plus-circle" id="fa-add" onclick="duplicate()"></i>
                            <i class="fas fa-minus-circle" id="fa-minus" onclick="removeDuplicate()"></i>
                        </section>
                        
                        <section id="bottom-part">
                            <label for="check-up">Check-up</label>
                            <span class="error" id="final-error2" onclick="popoff(this)">This field is requred</span>
                            <input id="check-up" type="number" class="final-inputs sum-price">
                        </section>
                        <section id="bottom-part">
                            <label for="labor">Labor</label>
                            <span class="error" id="final-error3" onclick="popoff(this)">This field is requred</span>
                            <input id="labor" type="number" class="final-inputs sum-price">
                        </section>
                        <section id="bottom-part">
                            <label for="total">Total</label>
                            <span class="error" id="final-error4" onclick="popoff(this)">This field is requred</span>
                            <input id="total-price" type="number" class="final-inputs" onclick="getTotal()" readonly>
                        </section>
                        <section id="bottom-part">
                            <label for="technician">Technician</label>
                            <span class="error" id="final-error4" onclick="popoff(this)">This field is requred</span>
                            <input id="technician" type="text" class="final-inputs">
                        </section>
                        <section id="bottom-part">
                            <label for="warranty">Warranty Exp.</label>
                            <!-- <span class="error" id="final-error2" onclick="popoff(this)">This field is requred</span> -->
                            <input id="warranty" type="date" class="final-inputs">
                        </section>

                        <button class="submit" onclick="finalChecker('forms','add-joborder-final', 'final-inputs','final-error')">Submit</button>
                    </div>
            </div>


            <!-- ----------------Job Order Add Form----------------- -->
            <div class="add-joborder" id="add-joborder"  style="display: none;" >
                <div class="back-button" onclick="closer('forms','add-joborder')">
                    <img src="resources/back_icon.png" alt="">
                </div>
                <div class="heading">
                    <div class="text">
                        <h4>Job Order</h4>
                    <p>Fill in Information Needed</p>
                    </div>
                    <img src="resources/logo.png" alt="">
                </div>
                <img class="wave" src="resources/wave1.png" alt="wave">
                <!-- <div class="input-section"> -->
                    <div class="input-section">
                        <section>
                            <i class="far fa-user"></i>
                            <span class="error" id="error1" onclick="popoff(this)">This field is requred</span>
                            <input type="text" placeholder="Name" id="input1" class="inputfield">
                            <i class="far fa-calendar"></i>
                            <span class="error" id="error2" onclick="popoff(this)">This field is requred</span>
                            <input type="date" placeholder="Date" id="input2" class="inputfield">
                        </section>
                        <section>
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="error" id="error3" onclick="popoff(this)">This field is requred</span>
                            <input type="text" placeholder="Address" id="input3" class="inputfield">
                            <i class="fas fa-sim-card"></i>
                            <span class="error" id="error4" onclick="popoff(this)">This field is requred</span>
                            <input type="number" placeholder="Number" id="input4" class="inputfield">
                        </section>
                        <section>
                            <span class="error" id="error5" onclick="popoff(this)">This field is requred</span>
                            <select name="device" id="input5" class="input5 inputfield" onchange="otherDevice(this)" >
                                <option value="" disabled selected>Select Device</option>
                                <option value="LED TV">LED TV</option>
                                <option value="Washing Machine">Washing Machine</option>
                                <option value="Refrigerator">Refrigerator</option>
                                <option value="Freezer">Freezer</option>
                                <option value="Split Type">Split Type</option>
                                <option value="Window Type">Window Type</option>
                                <option value="others">Others</option>
                            </select>
                                <input type="text" id="other-div" placeholder="Specify..." style="display: none;">
                            <i class="fas fa-briefcase"></i>
                            <span class="error" id="error6" onclick="popoff(this)">This field is requred</span>
                            <input type="text" placeholder="Accessories" id="input6" class="inputfield">
                        </section>
                        <section>
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="error7" onclick="popoff(this)">This field is requred</span>
                            <input type="number" placeholder="Model Number" id="input7" class="inputfield">
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="error8" onclick="popoff(this)">This field is requred</span>
                            <input type="text" placeholder="Brand Name" id="input8" class="inputfield">
                        </section>
                        <section>
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="error9" onclick="popoff(this)">This field is requred</span>
                            <input type="number" placeholder="Serial Number" id="input9" class="inputfield">
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="error10" onclick="popoff(this)">This field is requred</span>
                            <input type="text" placeholder="Complain" id="input10" class="inputfield">
                        </section>
                        <div class="bottom">
                            <div>
                                <label for="">Warranty</label><br>
                                <span class="error" id="error11" onclick="popoff(this)">This field is requred</span>
                                <select id="warranty" class="input11 inputfield">
                                    <option value="" disabled selected>Select One</option>
                                    <option value="In">In</option>
                                    <option value="Out">Out</option>
                                    <option value="Shop">Shop</option>
                                </select>
                            </div>
                            <div>
                                <label for="">Type of Repair</label><br>
                                <span class="error" id="error12" onclick="popoff(this)">This field is requred</span>
                                <select name="repair" id="repair" class="input12 inputfield">
                                    <option value="" disabled selected>Select One</option>
                                    <option value="Shop">Shop</option>
                                    <option value="Field">Field</option>
                                    <option value="Dealer">Dealer</option>
                                </select>
                            </div>
                        </div>

                        <button class="submit" onclick="checker('forms','add-joborder', 'inputfield','error')">Submit</button>
                    </div>
            </div>


            <!-- ----------------Inventory Add Form------------------- -->
            <div class="add-inventory" id="add-inventory" style="display: none;">
                <div class="back-button" onclick="closer('forms','add-inventory')">
                    <img src="resources/back_icon.png" alt="">
                </div>
                <div class="heading">
                    <div class="text">
                        <h4>Inventory Add Form</h4>
                    <p>Fill in Information Needed</p>
                    </div>
                    <img src="resources/logo.png" alt="">
                </div>
                <img class="wave" src="resources/wave4.png" alt="wave">
                <div class="input-section">
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="inventory-error1" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="Product Number" class="inventory-input">
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="inventory-error2" onclick="popoff(this)">This field is requred</span>
                        <input type="text" placeholder="Product Name" class="inventory-input">
                    </section>
                    <section>
                        <i class="fas fa-tag"></i>
                        <span class="error" id="inventory-error3" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="Price" class="inventory-input">
                    </section>
                    <section>
                        <i class="fas fa-arrow-circle-right"></i>
                        <span class="error" id="inventory-error4" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="Quantity" class="inventory-input">
                    </section>
                    <div>
                        <button class="submit" onclick="checker('forms','add-inventory', 'inventory-input', 'inventory-error')">Submit</button>
                    </div>
                </div>

            </div>


            <!--------------------Inventory Update Form--------------------->
            <div class="add-inventory update-inventory" id="update-inventory" style="display: none;">
                <div class="back-button" onclick="closer('forms','update-inventory')">
                    <img src="resources/back_icon.png" alt="">
                </div>
                <div class="heading">
                    <div class="text">
                        <h4>Inventory Add Form</h4>
                    <p>Fill in Information Needed</p>
                    </div>
                    <img src="resources/logo.png" alt="">
                </div>
                <img class="wave" src="resources/wave4.png" alt="wave">
                <div class="input-section">
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="update-inventory-error1" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="Product Number" class="update-inventory-input" readonly>
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="update-inventory-error2" onclick="popoff(this)">This field is requred</span>
                        <input type="text" placeholder="Product Name" class="update-inventory-input" >
                    </section>
                    <section>
                        <i class="fas fa-tag"></i>
                        <span class="error" id="update-inventory-error3" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="Price" class="update-inventory-input" >
                    </section>
                    <section>
                        <i class="fas fa-arrow-circle-right"></i>
                        <span class="error" id="update-inventory-error4" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="Quantity" class="update-inventory-input" id="inventory_quantity">
                    </section>

                    <section id="debit-credit">
                        <div id="debit-div" class="debit-credit">
                            <label for="debit">To Add</label><br>
                            <input type="number" id="debit" min="0" onchange="modifyQuantity('debit')">
                        </div>
                        <div id="credit-div" class="debit-credit">
                            <label for="credit">To Subtract</label><br>
                            <input type="number" id="credit" min="0" onchange="modifyQuantity('credit')">
                        </div>
                    </section>
                    <div>
                        <button class="submit" onclick="checker('forms','update-inventory', 'update-inventory-input', 'update-inventory-error')">Update</button>
                    </div>
                </div>
            </div>




            <!-- -----------------Employee Add Form------------- -->
            <div class="add-employee" id="add-employee" style="display: none;">
                <div class="back-button" onclick="closer('forms','add-employee')">
                    <img src="resources/back_icon.png" alt="">
                </div>
                <div class="heading">
                    <div class="text">
                        <h4>Employee Add Form</h4>
                    <p>Fill in Information Needed</p>
                    </div>
                    <img src="resources/logo.png" alt="">
                </div>
                <img class="wave" src="resources/wave4.png" alt="wave">
                <div class="input-section">
                    <section>
                        <i class="far fa-user"></i>
                        <span class="error" id="employee-error1" onclick="popoff(this)">This field is requred</span>
                        <input type="text" placeholder="Name" class="employee-input">
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="employee-error2" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="TIN"
                        class="employee-input">
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="employee-error3" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="SSS"
                        class="employee-input">
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="employee-error4" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="PAGIBIG"
                        class="employee-input">
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="employee-error5" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="PHILHEALTH" class="employee-input">
                    </section>
                    <div>
                        <button class="submit" onclick="checker('forms','add-employee','employee-input','employee-error')">Submit</button>
                    </div>
                </div>
            </div>


            <!-- -----------------Update Employee Form------------- -->
            <div class="add-employee update-employee" id="update-employee" style="display: none;">
                <div class="back-button" onclick="closer('forms','update-employee')">
                    <img src="resources/back_icon.png" alt="">
                </div>
                <div class="heading">
                    <div class="text">
                        <h4>Employee Update Form</h4>
                    <p>Fill in Information Needed</p>
                    </div>
                    <img src="resources/logo.png" alt="">
                </div>
                <img class="wave" src="resources/wave4.png" alt="wave">
                <div class="input-section">
                    <section>
                        <i class="far fa-user"></i>
                        <span class="error" id="upemployee-error1" onclick="popoff(this)">This field is requred</span>
                        <input type="text" placeholder="Name" class="upemployee-input">
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="upemployee-error2" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="TIN"
                        class="upemployee-input">
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="upemployee-error3" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="SSS"
                        class="upemployee-input">
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="upemployee-error4" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="PAGIBIG"
                        class="upemployee-input">
                    </section>
                    <section>
                        <i class="far fa-address-card"></i>
                        <span class="error" id="upemployee-error5" onclick="popoff(this)">This field is requred</span>
                        <input type="number" placeholder="PHILHEALTH" class="upemployee-input">
                    </section>
                    <div>
                        <button class="submit" onclick="checker('forms','update-employee','upemployee-input','upemployee-error')">Update</button>
                    </div>
                </div>
            </div>

            <!-- ----------------Installation Add Form----------------- -->
            <div class="add-installation add-joborder" id="add-installation"  style="display: none;" >
                <div class="back-button" onclick="closer('forms','add-installation')">
                    <img src="resources/back_icon.png" alt="">
                </div>
                <div class="heading">
                    <div class="text">
                        <h4>AC Installation</h4>
                    <p>Fill in Information Needed</p>
                    </div>
                    <img src="resources/logo.png" alt="">
                </div>
                <img class="wave" src="resources/wave1.png" alt="wave">
                <!-- <div class="input-section"> -->
                    <div class="input-section">
                        <section>
                            <i class="far fa-user"></i>
                            <span class="error" id="installation-error1" onclick="popoff(this)">This field is required</span>
                            <input type="text" placeholder="Name" id="input1" class="installation-input">
                            <i class="far fa-calendar"></i>
                            <span class="error" id="installation-error2" onclick="popoff(this)">This field is required</span>
                            <input type="date" placeholder="Date" id="input2" class="installation-input">
                        </section>
                        <section>
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="error" id="installation-error3" onclick="popoff(this)">This field is required</span>
                            <input type="text" placeholder="Address" id="input3" class="installation-input">
                            <i class="fas fa-sim-card"></i>
                            <span class="error" id="installation-error4" onclick="popoff(this)">This field is required</span>
                            <input type="number" placeholder="Number" id="input4" class="installation-input">
                        </section>
                        <section>
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="installation-error5" onclick="popoff(this)">This field is required</span>
                            <input type="text" placeholder="Brand Name" id="input5" class="installation-input">
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="installation-error6" onclick="popoff(this)">This field is required</span>
                            <input type="text" placeholder="Model Name" id="input6"  class="installation-input">
                        </section>
                        <section>
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="installation-error7" onclick="popoff(this)">This field is required</span>
                            <input type="number" placeholder="Model Number" id="input7"  class="installation-input">
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="installation-error8" onclick="popoff(this)">This field is required</span>
                            <input type="number" placeholder="Serial Number" id="input8"  class="installation-input">
                        </section>
                        <div class="bottom">
                            <div class='input-field'>
                              <span class="error" id="installation-error9" onclick="popoff(this)">This field is required</span>
                              <h4 class='lighter'>Labor</h4>
                              <input type='text' class='installation-input' id="input9" />
                            </div>
                            <div class='input-field'>
                              <span class="error" id="installation-error10" onclick="popoff(this)">This field is required</span>
                              <h4>Total</h4>
                              <input type='text' class='installation-input' id="input10"/>
                            </div>   
                        </div>

                        <button class="submit" onclick="checker('forms','add-installation', 'installation-input','installation-error')">Submit</button>
                    </div>
            </div>

            <!-- ----------------Installation Update Form----------------- -->
            <div class="add-installation add-joborder" id="update-installation"  style="display: none;" >
                <div class="back-button" onclick="closer('forms','update-installation')">
                    <img src="resources/back_icon.png" alt="">
                </div>
                <div class="heading">
                    <div class="text">
                        <h4>Update Installation</h4>
                    <p>Fill in Information Needed</p>
                    </div>
                    <img src="resources/logo.png" alt="">
                </div>
                <img class="wave" src="resources/wave1.png" alt="wave">
                <!-- <div class="input-section"> -->
                    <div class="input-section">
                        <section>
                            <i class="far fa-user"></i>
                            <span class="error" id="upinstallation-error1" onclick="popoff(this)">This field is required</span>
                            <input type="text" placeholder="Name" class="update-installation-input">
                            <i class="far fa-calendar"></i>
                            <span class="error" id="upinstallation-error2" onclick="popoff(this)">This field is required</span>
                            <input type="text" placeholder="Date" class="update-installation-input">
                        </section>
                        <section>
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="error" id="upinstallation-error3" onclick="popoff(this)">This field is required</span>
                            <input type="text" placeholder="Address" class="update-installation-input">
                            <i class="fas fa-sim-card"></i>
                            <span class="error" id="upinstallation-error4" onclick="popoff(this)">This field is required</span>
                            <input type="number" placeholder="Number" class="update-installation-input">
                        </section>
                        <section>
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="upinstallation-error5" onclick="popoff(this)">This field is required</span>
                            <input type="text" placeholder="Brand Name"  class="update-installation-input">
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="upinstallation-error6" onclick="popoff(this)">This field is required</span>
                            <input type="text" placeholder="Model Name"   class="update-installation-input">
                        </section>
                        <section>
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="upinstallation-error7" onclick="popoff(this)">This field is required</span>
                            <input type="number" placeholder="Model Number"  class="update-installation-input">
                            <i class="fas fa-arrow-circle-right"></i>
                            <span class="error" id="upinstallation-error8" onclick="popoff(this)">This field is required</span>
                            <input type="number" placeholder="Serial Number"  class="update-installation-input">
                        </section>
                        <div class="bottom">
                            <div class='input-field'>
                              <span class="error" id="upinstallation-error9" onclick="popoff(this)">This field is required</span>
                              <h4 class='lighter'>Labor</h4>
                              <input type='text' class='update-installation-input' />
                            </div>
                            <div class='input-field'>
                              <span class="error" id="upinstallation-error10" onclick="popoff(this)">This field is required</span>
                              <h4>Total</h4>
                              <input type='text' class='update-installation-input'/>
                            </div>   
                        </div>
                        <span>No. <input id='update-installation-no' type='number' class='update-installation-input' readonly /></span>
                        <button class="submit" onclick="checker('forms','update-installation', 'update-installation-input','upinstallation-error')">Submit</button>
                    </div>
            </div>
            <!------------------------  ------------------------>
            
            <div style="height: 100px;">
                All rights Reserved 
            </div>

        </div>


        <!-- sidebar -->
            <div class="sidebar">
                <div class="logo-section">
                    <img src="resources/logo.png" alt="" class="logo">
                    <h4>Roll Electornics</h4>
                </div>
                <div class="button-section">
                    <div class="nav-button" id="nb1" onclick="joborderButton()">Job Order</div>
                    <div class="nav-button" id="nb2" onclick="inventoryButton()">Inventory</div>
                    <div class="nav-button" id="nb3" onclick="employeeButton()">Employee</div>
                    <div class="nav-button" id="nb4" onclick="schedulesButton()">Schedules</div>
                    <div class="nav-button" id="nb5" onclick="installationButton()">Installation</div>
                </div>
                
            </div>
        <!-- wave -->
            <div style="height: 101%; overflow: hidden;" >
                <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M395.47,-2.30 C-320.58,76.64 806.11,46.42 201.02,149.14 L-0.00,149.14 L-0.00,0.00 Z" style="stroke: none; fill: #3498DB;"></path></svg>
            </div>

        <!-- content-panel -->
            <div class="content-panel">
                
                <!-- Job Order Panel -->
                <div class="panel-joborder" id="panel-joborder">
                    <div class="button-div">
                        <div class="add-button" onclick="popout('forms','add-joborder')"><i class="fas fa-plus-square fa-2x"></i>Add</div>
                        <input id="joborder-search" type="text" placeholder="Search Name..." onkeyup="search()">
                        
                    </div>
                    <div class="table-div">
                        <div id="filter-button-div">
                            <button class="filter-buttons fbtns" onclick="filter(this,'')" style="background-color: #3498DB;">All</button>
                            <button class="filter-buttons fbtns" onclick="filter(this,'Pending')">Pending</button>
                            <button class="filter-buttons fbtns" onclick="filter(this,'Finished')">Finished</button>
                        </div>
                        <table class="joborder-table" id="joborder-table">
                            <tr class="table-heading">
                                <th>Job Order Number</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Details</th>
                                <th>Status</th>
                            </tr>
                            <!-- PHP Codes for table -->
                            <?php

                                $sql = "SELECT * FROM joborder";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0){
                                    $i = 0;
                                        while($row = $result->fetch_assoc()){
                                            echo '<tr onclick = "editJobOrder(this)"><td>' . $row['JON'] . '</td><td>' .  $row["Name"] . '</td><td>' . $row["Date"] . '</td><td style="display: none;">' . $row["Address"] . '</td><td style="display: none;">' . $row["Number"] . '</td><td>' . $row["Device_Type"] . '</td><td style="display: none;">' . $row["Accessories"] . '</td><td style="display: none;">' . $row["Model_Number"] . '</td><td style="display: none;">' . $row["Brand_Name"] . '</td><td style="display: none;">' . $row["Serial_Number"] . '</td><td style="display: none;">' . $row["Complain"] . '</td><td style="display: none;">' . $row["Warranty"] . '</td><td style="display: none;">' . $row["Type_of_Repair"] . '</td><td style="display: none;">' . $row["Findings"] . '</td><td style="display: none;">' . $row["Materials"] . '</td><td style="display: none;">' . $row["Check_up"] . '</td><td style="display: none;">' . $row["Labor"] . '</td><td style="display: none;">' . $row["Total"] . '</td><td style="display: none;">' . $row["Technician"] . '</td><td style="display: none;">' . $row["Warranty_exp"] . '</td><td>' . $row["Status"] . '</td></tr>';
                                            $i++;
                                        }
                                }
                            ?>
                        </table>
                    </div>
                </div>
                <!-- Inventory Panel -->
                <div class="panel-inventory" id="panel-inventory" style="display: none">
                    <div class="button-div">
                        <div class="add-button" onclick="popout('forms','add-inventory')"><i class="fas fa-plus-square fa-2x"></i>Add</div>
                    </div>
                    <div class="table-div">
                        <div id="nav_buttons">
                            <button class="nav_buttons filter-buttons" onclick="showLogs(this, 'inventory-table')" style="background-color: #3498DB;">Inventory Items</button>
                            <button class="nav_buttons filter-buttons" onclick="showLogs(this, 'inventory-logs')">Inventory Logs</button>
                        </div>
                        <div id="inventory-table">
                            <table class="inventory-table">
                                <tr class="table-heading">
                                    <th>Product Number</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                                <!-- PHP Codes for table -->
                                <?php

                                    $sql = "SELECT * FROM inventory";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0){
                                        $i = 0;
                                            while($row = $result->fetch_assoc()){
                                                echo '<tr onclick = "editInputs(this, '."'inventory'".')"><td>' . $row['Product_Number'] . '</td><td>' .  $row["Name"] . '</td><td>' . $row["Price"] . '</td><td>' . $row["Quantity"] . '</td></tr>';
                                                $i++;
                                            }
                                    }
                                ?>
                            </table>
                        </div>

                        <div id="inventory-logs" style="display: none; height: 100%;">

                            <div id="inventory-logs-table">
                                <table class="inventory-table" >
                                    <tr class="table-heading">
                                        <th>Date</th>
                                        <th>Product_Name</th>
                                        <th>Product_Number</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                    <!-- PHP Codes for table -->
                                    <?php

                                        $sql = "SELECT * FROM inventory_logs";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0){
                                            $i = 0;
                                                while($row = $result->fetch_assoc()){
                                                    echo '<tr onclick = "editInputs(this, '."'logs'".')"><td>' . $row['Date'] . '</td><td>' .  $row["Product_Name"] . '</td><td>' . $row["Product_Number"] . '</td><td>' . $row["Debit"] . '</td><td>' . $row["Credit"] . '</td><td>' . $row["Price"] . '</td><td>' . $row["Quantity"] . '</td></tr>';
                                                    $i++;
                                                }
                                        }
                                    ?>
                                </table>
                            </div>
                            
                        </div>

                    </div>
                </div>
                <!-- Employee Panel -->
                <div class="panel-employee" id="panel-employee" style="display: none;">
                    <div class="button-div">
                        <div class="add-button" onclick="popout('forms','add-employee')"><i class="fas fa-plus-square fa-2x"></i>Add</div>
                    </div>
                    <div class="table-div">
                        <table class="employee-table">
                            <tr class="table-heading">
                                <th>Name</th>
                                <th>TIN</th>
                                <th>SSS</th>
                                <th>PAGIBIG</th>
                                <th>PHILHEALTH</th>
                            </tr>
                            <!-- PHP Codes for table -->
                            <?php

                                $sql = "SELECT * FROM employee";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0){
                                    $i = 0;
                                        while($row = $result->fetch_assoc()){
                                            echo '<tr onclick = "editInputs(this, '."'employee'".')"><td>' . $row['Name'] . '</td><td>' .  $row["TIN"] . '</td><td>' . $row["SSS"] . '</td><td>' . $row["PAGIBIG"] . '</td><td>' . $row["PHILHEALTH"] . '</td></tr>';
                                            $i++;
                                        }
                                }
                            ?>
                        </table>
                    </div>
                </div>


                <!-- Schedules Panel -->
                <div class="panel-schedules" id="panel-schedules" style="display: none;">
                    <div class="button-div">
                        <div class="add-button" onclick="popout('forms','add-joborder')"><i class="fas fa-plus-square fa-2x"></i>Add</div>
                        <input id="joborder-search" type="text" placeholder="Search Name..." onkeyup="search()">
                    </div>
                    <div class="table-div">
                        <table class="schedules-table" id="schedules-table">
                                <tr class="table-heading">
                                    <th>No.</th>
                                    <th>Customer Name</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                                <!-- PHP Codes for table -->
                                <?php
                                    $sql = "SELECT * FROM schedules";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0){
                                        $i = 0;
                                            while($row = $result->fetch_assoc()){
                                                echo '<tr onclick = "editInputs(this, '."'schedules'".')"><td>' . $row['JON'] . '</td><td>' .  $row["Name"] . '</td><td>' . $row["Type"] . '</td><td>' . $row["Date"] . '</td></tr>';
                                                $i++;
                                            }
                                    }
                                ?>
                        </table>
                    </div>
                </div>


                <!-- Installation Panel -->
                <div class="panel-installation" id="panel-installation" style="display: none;">
                    <div class="button-div">
                        <div class="add-button" onclick="popout('forms','add-installation')"><i class="fas fa-plus-square fa-2x"></i>Add</div>
                        <input id="joborder-search" type="text" placeholder="Search Name..." onkeyup="search()">
                    </div>
                    <div class="table-div">
                        <table class="installation-table" id="installation-table">
                                <tr class="table-heading">
                                    <th>Installation Order No.</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                                <?php

                                $sql = "SELECT * FROM installation";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0){
                                    $i = 0;
                                        while($row = $result->fetch_assoc()){
                                            echo '<tr onclick = "editInstallation(this)"><td>' . $row['Order_Number'] . '</td><td>' .  $row["Name"] . '</td><td>' . $row["Date"] . '</td><td style="display:none;">' .  $row["Address"] . '</td><td style="display:none;">' .  $row["Number"] . '</td><td style="display:none;">' . $row["Brand_Name"] . '</td><td>' . $row["Model_Name"] . '</td><td style="display:none;">' .  $row["Model_Number"] . '</td><td style="display:none;">' .  $row["Serial_Number"] . '</td><td style="display:none;">' .  $row["Labor"] . '</td><td style="display:none;">' .  $row["Total"] . '</td><td>'. $row["Status"] .'</td></tr>';
                                            $i++;
                                        }
                                }
                            ?>
                        </table>
                    </div>
                </div>


            </div>
    </div>
</body>
</html>
