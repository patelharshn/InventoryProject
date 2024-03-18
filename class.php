<?php
include('command/conn.php');
include('fpdf/fpdf.php');
session_start();
if (!isset($_COOKIE['email']) && !isset($_COOKIE['pass'])) {
    header("Location: http://localhost/newproject/login/index.php");
    exit;
}


if (isset($_POST['p_name']) && isset($_POST['u_id'])) {
    $productName = $_POST['p_name'];
    $uid = $_POST['u_id'];

    $q = "select buy_price from product where product_name='$productName' AND user_id='$uid'";
    $result = mysqli_query($con, $q);
    while ($row = mysqli_fetch_row($result)) {
        echo $row[0];
    }
}

if (isset($_POST['pname']) && isset($_POST['uid'])) {
    $productName = $_POST['pname'];
    $uid = $_POST['uid'];

    $q = "select sell_price from product where product_name='$productName' AND user_id='$uid'";
    $result = mysqli_query($con, $q);
    while ($row = mysqli_fetch_row($result)) {
        echo $row[0];
    }
}

if (isset($_POST['P_Name']) && isset($_POST['U_Id'])) {
    $productName = $_POST['P_Name'];
    $uid = $_POST['U_Id'];

    $q = "select id from product where product_name='$productName' AND user_id='$uid'";
    $result = mysqli_query($con, $q);
    while ($row = mysqli_fetch_row($result)) {
        echo $row[0];
    }
}


if (isset($_POST['btn_bill'])) {
    if (isset($_SESSION['sales'])) {
        $pdf = new FPDF();

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 25);

        $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
        $pdf->Line(10, 25, 200, 25);

        $pdf->Cell(10, 10, '', 0, 1, 'L');
        $pdf->SetFont('Courier', '', 15);
        $pdf->Cell(10, 10, 'Customer Details', 0, 1, 'L');
        $pdf->Cell(10, 10, $_SESSION['cname'], 0, 1, 'L');
        $pdf->Cell(10, 1, 'Surat', 0, 1, 'L');
        $pdf->Cell(10, 10, '395017', 0, 1, 'L');

        // $pdf->Cell(0, 10, 'Line1', 0, 1, 'L');
        // $pdf->Cell(0, 10, 'Line1', 0, 1, 'R');
        // $pdf->Cell(0, 10, 'Line1', 0, 1, 'C');
        // $pdf->Cell(0, 10, 'Line1', 0, 1, 'R');



        foreach ($_SESSION['sales'] as $key => $val) {
            // $pdf->Cell(40, 10, $val['pname']);
            // $pdf->Ln(10);
            // $pdf->Cell(40, 10, $val['qty']);
            // $pdf->Ln(10);
            // $pdf->Cell(40, 10, $val['price']);
            // $pdf->Ln(10);
            // $pdf->Cell(40, 10, $val['total']);
            // $pdf->Ln(10);
        }
        $pdf->Output("I", "001.pdf");
        // unset($_SESSION['sales']);
        // unset($_SESSION['cname']);
    } else {
        $_SESSION['sale_message'] = "No any product add for Sale...";
        $_SESSION['icon'] = "error";
        $_SESSION['title'] = "Error...";
        header("Location: http://localhost/newproject/sales_extra.php");
        exit();
    }
}
