<!DOCTYPE html>
<html lang="en" data-layout="topnav">

<head>
    <meta charset="utf-8" />
    <title>Adminto - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Vector Maps css -->
    <link href="<?php echo base_url()?>public/assets/Adminto2/vendor/jsvectormap/jsvectormap.min.css" rel="stylesheet" type="text/css">

    <!-- Theme Config Js -->
    <script src="<?php echo base_url()?>public/assets/Adminto2/js/config.js"></script>

    <!-- Vendor css -->
    <link href="<?php echo base_url()?>public/assets/Adminto2/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?php echo base_url()?>public/assets/Adminto2/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="<?php echo base_url()?>public/assets/Adminto2/css/icons.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        .gwc-button{
            background: #b28a3d;
            color:#fff;
            font-weight: 500;
        }

        .gwc-button:hover{
            color: #fff;
            background: #d7b564;
        }

        .gwc-font, #sidebar-menu>ul>li>a, .header-title, .page-title-main{
            font-family: "Avenir";
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        <br>

        <center>
            <img src="<?php echo base_url();?>public/assets/adminto/images/primary.png" height="30">
        </center>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            <div class="page-container">

                <div class="row" id="div_loanApplicationOption">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <h4>LOAN APPLICATION</h4>
                                    <br>
                                    <button class="btn gwc-button" id="btn_businessExpansionLoan" style="width:100%;">BUSINESS EXPANSION LOAN</button>
                                    <div class="m-2"></div>
                                    <button class="btn gwc-button" id="btn_paymentNowLoan" style="width:100%;">PAYMENT NOW</button>
                                    <br>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>

                <div class="container" id="div_loanApplicationForm" hidden>
                    <div class="card">
                        <div class="card-body">
                            
                            <center>
                                <h4>PAYNOW LOAN APPLICATION FORM</h4>
                            </center>

                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="bg-dark text-light"><center>LOAN INFORMATION</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            LOAN AMOUNT: <input type="text" name="">
                                        </td>
                                        <td>
                                            DESIRED TERM (MONTH): 
                                            <input type="radio" name="rdb_paymentTerms"> 6
                                            <input type="radio" name="rdb_paymentTerms"> 12
                                            <input type="radio" name="rdb_paymentTerms"> 18
                                            <input type="radio" name="rdb_paymentTerms"> 24
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            PURPOSE: 
                                            <input type="checkbox" name=""> I have a PO and I need working capital 
                                            <input type="checkbox" name=""> I need to aquire new equipment
                                            <input type="checkbox" name=""> Other purposes <input type="text" name="" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="bg-dark text-light">
                                            <center>BORROWER'S PERSONAL INFORMATION</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    FIRST NAME: <br>
                                                    <input type="text" name="">
                                                </div>
                                                <div class="col-4">
                                                    MIDDLE NAME: <br>
                                                    <input type="text" name="">
                                                </div>
                                                <div class="col-4">
                                                    LAST NAME: <br>
                                                    <input type="text" name="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            BIRTHDATE (mm/dd/yyyy): <br>
                                            <input type="date" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    SEX: <br>
                                                    <input type="radio" name=""> MALE
                                                    <input type="radio" name=""> FEMALE
                                                </div>
                                                <div class="col-4">
                                                    BIRTH PLACE: <br>
                                                    <input type="text" name="">
                                                </div>
                                                <div class="col-4">
                                                    NATIONALITY: <br>
                                                    <input type="text" name="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            MOTHER'S FULL MAIDEN NAME: <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            MARITAL STATUS : 
                                            <input type="radio" name="rdb_maritalStatus"> SINGLE
                                            <input type="radio" name="rdb_maritalStatus"> MARRIED
                                            <input type="radio" name="rdb_maritalStatus"> SEPARATED
                                            <input type="radio" name="rdb_maritalStatus"> WIDOWED
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <tbody>
                                    <tr>
                                        <td width="35%">NAME OF DEPENDENTS</td>
                                        <td width="30%">AGE</td>
                                        <td width="35%">SCHOOL</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="number" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="number" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="number" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    PRESENT ADDRESS:
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="" style="width: 100%;">
                                                </div>
                                            </div>
                                        </td>
                                        <td width="35%">
                                            <div class="row">
                                                <div class="col-5">LENGTH OF STAY:</div>
                                                <div class="col-7"><input type="number" name="" style="width: 100%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    PERMANENT ADDRESS:
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="" style="width: 100%;">
                                                </div>
                                            </div>
                                        </td>
                                        <td width="35%">
                                            <div class="row">
                                                <div class="col-5">LENGTH OF STAY:</div>
                                                <div class="col-7"><input type="number" name="" style="width: 100%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            TEL NO. <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            MOBILE NO. <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            EMAIL ADDRESS <br>
                                            <input type="email" name="">
                                        </td>
                                        <td>
                                            TIN/GISS/SSS/PRC NO. <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            RESIDENCE OWNERSHIP <br>
                                            <input type="radio" name=""> OWNED
                                            <input type="radio" name=""> MORTGAGE
                                            <input type="radio" name=""> RENTING (MONTHLY RENT)
                                            <input type="radio" name=""> USED FREE WITH PARENTS
                                            <input type="radio" name=""> OTHERS
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <tbody>
                                    <tr>
                                        <td width="40%">
                                            LAST SCHOOL ATTENDED <br>
                                            <input type="text" name="">
                                        </td>
                                        <td width="60%">
                                            OWNED VEHICLES <br>
                                            MAKE/SERIES: <input type="text" name="" style="width: 70px;">
                                            YEAR MODEL: <input type="text" name="" style="width: 50px;">
                                            AMORTIZATION: <input type="text" name="" style="width: 50px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="bg-dark text-light">
                                            <center>SOURCE OF INCOME</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            BUSINESS: 
                                            <input type="radio" name=""> SOLE PROPRIETOR
                                            <input type="radio" name=""> PARTNERSHIP
                                            <input type="radio" name=""> CORPORATION
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            BUSINESS NAME: <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            NATURE OF BUSINESS: <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            PRODUCTS: <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            DATE ESTABLISHED: <br>
                                            <input type="date" name="">
                                        </td>
                                        <td>
                                            TITLE/POSITION: <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            TEL NO.: <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <tbody>
                                    <tr>
                                        <td width="70%">
                                            BUSINESS ADDRESS: <br>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td width="30%">
                                            LENGTH OF STAY: <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            MONTHLY SALES/INCOME: <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            TOTAL MANPOWER: <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            OPERATING EXPENCE: <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            OTHER SOURCE OF INCOME: <br>
                                            <input type="radio" name=""> Investments
                                            <input type="radio" name=""> Other Business
                                            <input type="radio" name=""> Others 
                                            <input type="text" name="" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="bg-dark text-light">
                                            <center>SPOUSE / CO-BORROWER'S PERSONAL INFORMATION (if applicable)</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    FIRST NAME: <br>
                                                    <input type="text" name="">
                                                </div>
                                                <div class="col-4">
                                                    MIDDLE NAME: <br>
                                                    <input type="text" name="">
                                                </div>
                                                <div class="col-4">
                                                    LAST NAME: <br>
                                                    <input type="text" name="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            BIRTHDATE (mm/dd/yyyy): <br>
                                            <input type="date" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    SEX: <br>
                                                    <input type="radio" name=""> MALE
                                                    <input type="radio" name=""> FEMALE
                                                </div>
                                                <div class="col-4">
                                                    BIRTH PLACE: <br>
                                                    <input type="text" name="">
                                                </div>
                                                <div class="col-4">
                                                    NATIONALITY: <br>
                                                    <input type="text" name="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            MOTHER'S FULL MAIDEN NAME: <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="bg-dark text-light">
                                            <center>SPOUSE / CO-BORROWER'S EMPLOYMENT INFORMATION</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            EMPLOYED: <br>
                                            <input type="radio" name=""> PRIVATE
                                            <input type="radio" name=""> GOVERNMENT
                                            <input type="radio" name=""> OTHERS
                                            <input type="text" name="" readonly>
                                        </td>
                                        <td>
                                            BUSINESS: <br>
                                            <input type="radio" name=""> SOLE PROPRIETOR
                                            <input type="radio" name=""> PARTNERSHIP
                                            <input type="radio" name=""> CORPORATION
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <tbody>
                                    <tr>
                                        <td width="75%">
                                            EMPLOYER / BUSINESS NAME <br>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            TYPE OF INDUSTRY <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="75%">
                                            OFFICE ADDRESS <br>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            TEL NO. <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            TITLE / POSITION <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            YEARS EMPLOYED / IN OPERATION <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            MONTHLY GROSS INCOME <br>
                                            <input type="text" name="">
                                        </td>
                                        <td width="25%">
                                            MONTHLY EXPENSE <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            OTHER SOURCE OF INCOME <br>
                                            <input type="radio" name=""> Remittances
                                            <input type="radio" name=""> Investments
                                            <input type="radio" name=""> Other Business
                                            <input type="radio" name=""> Pension
                                            <input type="radio" name=""> Others 
                                            <input type="text" name="" disabled>
                                        </td>
                                        <td>
                                            MONTHLY INCOME <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            PRESENT ADDRESS <br>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            LENGTH OF STAY <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            TEL NO. <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            MOBILE NO. <br>
                                            <input type="text" name="">
                                        </td>
                                        <td>
                                            EMAIL ADDRESS <br>
                                            <input type="email" name="">
                                        </td>
                                        <td>
                                            TIN/GISS/SSS/PASSPORT NO. <br>
                                            <input type="text" name="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="bg-dark text-light">
                                            <center>BORROWER'S PERSONAL REFERENCE</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><center>NAME</center></td>
                                        <td><center>RELATION</center></td>
                                        <td><center>ADDRESS</center></td>
                                        <td><center>CONTACT NO.</center></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="" style="width: 100%;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="bg-dark text-light">
                                            <center>OTHER INFORMATION</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-4">
                                            <h5>A. BANK REFERENCES</h5>
                                            <table class="mb-2" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th><center>BANK</center></th>
                                                        <th><center>FACILITY</center></th>
                                                        <th><center>AMORTIZATION</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td rowspan="3" valign="middle" width="10%">
                                                            DEPOSIT
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="mb-3" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td rowspan="3" valign="middle" width="10%">
                                                            LOANS
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <h5>B. TRADE REFERENCES</h5>
                                            <table class="mb-2" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>SUPPLIERS</th>
                                                        <th>TEL NO.</th>
                                                        <th>CUSTOMERS</th>
                                                        <th>TEL NO.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" style="width: 100%;">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <br><br><br>

                                            <div style="width: 300px; border-top: 1px solid black;">
                                                <center>Signature over printed name</center>
                                                <br>
                                                <center>Date: <small><i>(mm/dd/yyyy)</i></small> ____________</center>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="bg-dark text-light">
                                            <center>BANK AUTHORIZATION</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-4">

                                            <p>This is to authorize GOLDWATER CAP FINANCING CORP., or its authorized representative to verify my/our Savings/Checking Account with your bank.</p>

                                            <br>

                                            <table class="mb-2" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th><center>Bank Account No.</center></th>
                                                        <th><center>Bank/Branch</center></th>
                                                        <th><center>Account Type</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <center><input type="text" name=""></center>
                                                        </td>
                                                        <td>
                                                            <center><input type="text" name=""></center>
                                                        </td>
                                                        <td>
                                                            <center><input type="text" name=""></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <center><input type="text" name=""></center>
                                                        </td>
                                                        <td>
                                                            <center><input type="text" name=""></center>
                                                        </td>
                                                        <td>
                                                            <center><input type="text" name=""></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <center><input type="text" name=""></center>
                                                        </td>
                                                        <td>
                                                            <center><input type="text" name=""></center>
                                                        </td>
                                                        <td>
                                                            <center><input type="text" name=""></center>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <br>

                                            <p>Thank you very much for your kind assistance.</p>

                                            <br>

                                            <div style="width: 300px; border-top: 1px solid black;">
                                                <center>Signature over printed name</center>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="bg-dark text-light">
                                            <center>UNDERTAKING AND AUTHORIZATION</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-4">

                                            <p style="text-align: justify;">
                                                I hereby CONSENT to and allow GOLDWATER CAP FINANCING CORPORATION or any of its Subsidiaries, Affiliates, Partners and accredited Third Party Service Providers to collect, retrieve, process, user and store my personal data such as my name, age, photograph, fingerprints, other biometric data {e.g., facial recognition and voice recognition}, mobile number/s, mobile phone usage data, employment details, income, financial data, financial profile, credit standing, loan payment history, and other information that may be1 required to process my load application. I fully understand and agree that my personal data will be processed for credit investigation, credit scoring, data analytics, collection, automated processing of the loan, data profiling, direct marketing of products and services of GOLDWATER CAP FINANCING CORPORATION or any of its Subsidiaries, Affiliates, and Partners.
                                            </p>

                                            <br>

                                            <div class="row">
                                                <div class="col-4">
                                                    <div style="width: 300px; border-top: 1px solid black;">
                                                        <center>Signature of Borrower over printed name</center>
                                                        <br>
                                                        <center>Date: <small><i>(mm/dd/yyyy)</i></small> ____________</center>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div style="width: 300px; border-top: 1px solid black;">
                                                        <center>Signature of Spouse over printed name</center>
                                                        <br>
                                                        <center>Date: <small><i>(mm/dd/yyyy)</i></small> ____________</center>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div style="width: 300px; border-top: 1px solid black;">
                                                        <center>Signature of Co-Borrower over printed name</center>
                                                        <br>
                                                        <center>Date: <small><i>(mm/dd/yyyy)</i></small> ____________</center>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="bg-dark text-light">
                                            <center>PRIVACY POLICY</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-4">

                                            <p style="text-align: justify;">
                                                Each Client is deemed to have the provisions of the Privacy Policy including the Collection, Process, Use, Distribution and Delivery, and Storage of data information by filling out this application form. At <b>GOLDWATER CAP FINANCING CORPORATION</b>, we are committed to protect the confidentiality and security of our clients at all times. We will not disclose information and data from our Clients, either through private or commercial transactions, unless required to do so by competent authority pursuant to Philippine law, rule, and regulation. 
                                            </p>

                                            <p style="text-align: justify;">
                                                Collection of Information and Data
                                            </p>

                                            <p style="text-align: justify;">
                                                Distribution and Provision of Information and Data is required in the process of the loan application for verification, validation, and confirmation of data. We apply this to our borrowers, subcontractors, service providers, Loan Consultants, and the authorities regulated by Philippine Law.
                                                <br>
                                                In the event of a request for information, we will notify the Client in advance through means including but not limited to email, phone call, and text, and Client may respond or object to the said notice. If we do not receive a response from the Client within three(3) days from the date of notification, then we will assume that the Client has no objection and hereby consents to the request for information. 
                                            </p>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <br>

                            <center>
                                <button type="button" class="btn gwc-button">Submit Application</button>
                            </center>

                        </div>
                    </div>
                </div>

            </div> <!-- container -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="<?php echo base_url(); ?>public/assets/Adminto2/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="<?php echo base_url(); ?>public/assets/Adminto2/js/app.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#btn_businessExpansionLoan').on('click',function(){
                $('#div_loanApplicationOption').prop('hidden',true);
                $('#div_loanApplicationForm').prop('hidden',false);
            });

            $('#btn_paymentNowLoan').on('click',function(){
                $('#div_loanApplicationOption').prop('hidden',true);
                $('#div_loanApplicationForm').prop('hidden',false);
            });
        });
    </script>

</body>

</html>