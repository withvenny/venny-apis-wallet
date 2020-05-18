<?php
 
    //
    header('Content-Type: application/json');

    //
    require 'autoload.php';
    require 'controllers/components/component-functions.php';
    require 'controllers/components/component-environments.php';

    //
    if(isset($_REQUEST['token'])) {

        //
        $request['token'] = $_REQUEST['token'];

        //
        if(isset($_REQUEST['app'])) {

            //
            $request['app'] = $_REQUEST['app'];
    
            //
            switch ($_REQUEST['domain']) {

                //
                case 'paymentmethods': require 'controllers/resources/resource-wallet-paymentmethodsorders.php'; break;
                case 'passes': require 'controllers/resources/resource-wallet-passes.php'; break;
    
                //
                default: header("Location: template-guest-hello.php");
            
            }

        } else { 

            // connect to the PostgreSQL database

            //$data = NULL;
            $code = 401;
            $message = "Forbidden - Valid App ID required";

            $results = array(
                'status' => $code,
                'message' => $message,
                /*
                'data' => $data,
                'log' => [
                    'process' => $process_id = Token::process_id(),
                    'event' => $event_id = Token::event_id($process_id)
                ]*/
            );
            
            $results = json_encode($results);
        
            echo $results;
        
        }

    } else {

        // connect to the PostgreSQL database

        //$data = NULL;
        $code = 401;
        $message = "Forbidden - Valid token required";

        $results = array(
            'status' => $code,
            'message' => $message,
            /*
            'data' => $data,
            'log' => [
                'process' => $process_id = Token::process_id(),
                'event' => $event_id = Token::event_id($process_id)
            ]*/
        );

        $results = json_encode($results);
        
        echo $results;

    }

?>
