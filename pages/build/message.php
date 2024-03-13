<?php
    include('connection.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Send Message</title>
</head>
<?php
    // encryption message
    function encrypting_message($message,$key) {
        $encrypted_message = strlen($message);
        $secret_key = strlen($key);

        $encrpyted_result_string = "";
        for ($i = 0; $i < $encrypted_message; $i++) {
            $encrpyted_result_string .= ($message[$i] ^ $key[$i % $secret_key]);
        }
        return $encrpyted_result_string;
    }

    function write_message($result_string,$sqlConn) {
        $message_query = "INSERT INTO message_table(message_box)
                            VALUES('$result_string')";
        if($sqlConn->query($message_query) == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    if(isset($_POST["submit_btn"]) && !empty($_POST['message_box'])) {
        $message_input = $_POST['message_box'];
        
        $result_string = encrypting_message($message_input,"secret");

        $write_response = write_message($result_string,$sqlConn);
        $response = ($write_response) ? "Message sent" : "Error cannot send";
        
        echo $response;
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        
    }
?>

<body class="m-40">
    <div class="container border-2 border-black mx-auto rounded-lg">
        <div class="h-52 w-full border-4 border-red-300 rounded-t-lg">
            <div class="overflow-y-scroll h-full">
                <!-- textbox container -->
                <div class="h-auto bg-gradient-to-br from-amber-100 to-slate-300 py-1">
                    <?php
                        // $get_message_query = "SELECT message_box FROM message_table WHERE send_to = ''";
                        // $message_frm_dbase = $sqlConn->query($get_message_query);

                        // $message_ascii = array();
                        // while($row_message = mysqli_fetch_assoc($message_frm_dbase)) {
                        //     for($i = 0; $i < count($row_message); $i++) {
                                
                        //         $message_ascii[$i] = $row_message['message_box'];
                                
                        //         $decrpyted_pass = encrypting_message($message_ascii[$i],'secret');
                        //         echo $decrpyted_pass ."<br>";
                        //     }
                        // }

                        
                            
                    ?>
                    <!-- sender screen -->
                    <div class="h-auto sender-message-container">
                        <?php
                            $current_user = $_SESSION['user_logged_in'];
                            $preview_message = "SELECT message_box from message_table ";
                            $sender_msg_prev = $sqlConn->query($preview_message);
                            // where send_to = '$current_user' UNION SELECT Username FROM accounts WHERE = '$current_user'

                            $message_input_array = array();
                            while($row_message = mysqli_fetch_assoc($sender_msg_prev)) {
                                for($i = 0; $i < count($row_message); $i++) {
                                    $message_ascii[$i] = $row_message['message_box'];
                                    $decrpyted_pass = encrypting_message($message_ascii[$i],'secret');
                                        
                                
                        ?>
                        <div class="message-content p-1  m-1 grid-cols-3 flex flex-row-reverse gap-x-2">
                            <div
                                class="grid place-content-center border-2 border-red-50 bg-red-400 rounded-full h-14 min-w-14">

                                <p class="text-xs text-black font-extrabold">
                                    <?php echo $_SESSION['user_logged_in'];  ?>
                                </p>

                            </div>
                            <div class="grid place-content-center border-4 border-violet-200 rounded-md">
                                <p class="text-xl bg-violet-400 p-3 rounded-sm">
                                    <?php echo $decrpyted_pass;  ?>
                                </p>
                            </div>
                        </div>
                        <?php
                                } 
                            }
                        ?>
                    </div>


                    <!-- end sender screen -->

                    <!-- other screen start-->
                    <!-- <div class="h-auto border-2 border-black sender-message-container">
                        <div class="message-content p-1 border-2 border-blue-700 m-1 grid-cols-3 flex gap-x-2">
                            <div class=" grid border-2 border-black bg-yellow-400 rounded-full h-12 min-w-12 "></div>
                            <div class="grid place-content-center border-2 border-black rounded-lg">
                                <p class="text-xl bg-violet-400 p-2 rounded-lg">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit eaque delectus
                                    consectetur dolore consequatur tenetur hic ab, earum atque temporibus.
                                </p>
                            </div>
                        </div>
                    </div> -->
                    <!-- other screen end -->
                </div>
            </div>
        </div>
        <form action="" method="post">
            <div class="message-container sm:mx-auto grid grid-col-3 bg-cyan-500 gap-3 p-2">
                <input type="text" name="message_box" id=""
                    class="min-w-6 rounded-xl col-start-1 col-end-5 border-2 focus:border-black placeholder:ps-2 focus:ps-2"
                    placeholder="Message. . .">
                <button name="submit_btn" type="submit"
                    class="min-w-6 border-2 border-slate-200 bg-slate-200 col-end-6 hover:bg-green-500 rounded-xl text-xs sm:text-xl font-semibold">Send</button>
                <button name="logout_btn" type="submit"
                    class="min-w-6 border-2 border-slate-200 bg-white col-end-7 hover:bg-red-500 rounded-xl text-xs sm:text-xl font-semibold">Logout</button>
            </div>
        </form>
    </div>
</body>
<?php
        if(isset($_POST["logout_btn"])) {
            session_destroy();
            // header("Location:login_account.php",true);
            echo "<script>window.location.href = 'login_account.php'</script>";
        }
    ?>

</html>