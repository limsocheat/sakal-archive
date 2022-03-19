<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student id card</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: Khmer OS Muol Light !important;
        }

        p {
            font-size: 18px;
        }

        .card .studnet_image {
            width: 633px !important;
            height: 1011px !important;
            max-width: 100% !important;
            max-height: 100% !important;
            margin-left: 180px !important;
            margin-top: 247px !important;
            border-radius: 50% !important;
        }

        .text-position {
            margin-left: 500px;
            margin-top: 160px;
        }

        @media print {
            @page {
                size: A4 portrait !important;
                margin: 0;

            }

            body {
                /* A5 dimensions */
                height: 100mm !important;
                width: 80mm !important;
                margin: 0;
            }

            .col-sm-1,
            .col-sm-2,
            .col-sm-3,
            .col-sm-4,
            .col-sm-5,
            .col-sm-6,
            .col-sm-7,
            .col-sm-8,
            .col-sm-9,
            .col-sm-10,
            .col-sm-11,
            .col-sm-12 {
                float: left;
            }

            .col-sm-12 {
                width: 100%;
            }

            .col-sm-11 {
                width: 91.66666667%;
            }

            .col-sm-10 {
                width: 83.33333333%;
            }

            .col-sm-9 {
                width: 75%;
            }

            .col-sm-8 {
                width: 66.66666667%;
            }

            .col-sm-7 {
                width: 58.33333333%;
            }

            .col-sm-6 {
                width: 50%;
            }

            .col-sm-5 {
                width: 41.66666667%;
            }

            .col-sm-4 {
                width: 33.33333333%;
            }

            .col-sm-3 {
                width: 25%;
            }

            .col-sm-2 {
                width: 16.66666667%;
            }

            .col-sm-1 {
                width: 8.33333333%;
            }

            /*  */
            .col-md-12 {
                width: 100%;
            }

            .col-md-11 {
                width: 91.66666667%;
            }

            .col-md-10 {
                width: 83.33333333%;
            }

            .col-md-9 {
                width: 75%;
            }

            .col-md-8 {
                width: 66.66666667%;
            }

            .col-md-7 {
                width: 58.33333333%;
            }

            .col-md-6 {
                width: 94%;
                padding-left: 6%;
                padding-right: 6%;
                padding-bottom: 2.3%;
            }

            .col-md-5 {
                width: 41.66666667%;
            }

            .col-md-4 {
                width: 33.33333333%;
            }

            .col-md-3 {
                width: 25%;
            }

            .col-md-2 {
                width: 16.66666667%;
            }

            .col-md-1 {
                width: 8.33333333%;
            }

            /*  */
            .card .card-img {
                /* width: 220mm !important;
                height: auto !important; */
            }

            .card {
                width: 633px !important;
                height: 1011px !important;
            }

            .text-position {
                margin-top: 230px;
                margin-left: 20mm !important;
            }

            .text-position p {
                font-size: 9mm !important;
                color: black !important;
                -webkit-print-color-adjust: exact;
            }
        }

    </style>
</head>

<body onload="window.print()">
    <div class="container py-4">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="card ">
                    <div class="card-header text-white" style="background-color: #88bf68">
                        <div class="row">
                            <div class="col-sm-2">
                                <img src="{{ asset('modules/student/images/UBB_logo.png') }}" alt="">
                            </div>
                            <div class="col-sm-10 text-center">
                                <h2 class="text-black">សាកលវិទ្យាល័យជាតិបាត់ដំបង</h2>
                                <h3>National University of Battambang</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-5">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>បណ្ណសម្គាល់ខ្លួនិស្សិត</h3>
                                <h4>Student Identity Card</h4>
                            </div>
                            <div class="col-sm-4">
                                <img src="{{ asset('modules/student/images/student_card.png') }}" width="200px"
                                    height="250px" alt="">
                                <p class="background-color:blue;">ID: 889745562</p>
                            </div>
                            <div class="col-sm-8">
                                <p>-ឈ្មោះ : ម៉ាង ហ្វាហ្ស៊ី</p>
                                <p>-ឈ្មោះជាឡាតាំង​ : Man FAZAY</p>
                                <p>-ថ្ងៃខែឆ្នាំកំណើត : ១០-ធ្នូ-១៩៩៨</p>
                                <p>-មហាវិទ្យាល័យ/វិទ្យាស្ថាន/សាលា :​ ក្រោយបរិញ្ញាបត្រ</p>
                                <p>-និស្សិតទី : ២ <span>ជំនាន់ទី : ១០</span></p>
                                <p>-ជំនាញ : គ្រប់គ្រងពាណិជ្ជកម្ម </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    </div>
</body>

</html>
