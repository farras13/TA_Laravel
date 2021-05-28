<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Invoice with ribbon - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{margin-top:20px; background:#eee;
        }

        /*Invoice*/
        .invoice .top-left {
            font-size:65px;
            color:#3ba0ff;
        }

        .invoice .top-right {
            text-align:right;
            padding-right:20px;
        }

        .invoice .table-row {
            margin-left:-15px;
            margin-right:-15px;
            margin-top:25px;
        }

        .invoice .payment-info {
            font-weight:500;
        }

        .invoice .table-row .table>thead {
            border-top:1px solid #ddd;
        }

        .invoice .table-row .table>thead>tr>th {
            border-bottom:none;
        }

        .invoice .table>tbody>tr>td {
            padding:8px 20px;
        }

        .invoice .invoice-total {
            margin-right:-10px;
            font-size:16px;
        }

        .invoice .last-row {
            border-bottom:1px solid #ddd;
        }

        .invoice-ribbon {
            width:85px;
            height:88px;
            overflow:hidden;
            position:absolute;
            top:-1px;
            right:14px;
        }

        .ribbon-inner {
            text-align:center;
            -webkit-transform:rotate(45deg);
            -moz-transform:rotate(45deg);
            -ms-transform:rotate(45deg);
            -o-transform:rotate(45deg);
            position:relative;
            padding:7px 0;
            left:-5px;
            top:11px;
            width:120px;
            background-color:#66c591;
            font-size:15px;
            color:#fff;
        }

        .ribbon-inner:before,.ribbon-inner:after {
            content:"";
            position:absolute;
        }

        .ribbon-inner:before {
            left:0;
        }

        .ribbon-inner:after {
            right:0;
        }

        @media(max-width:575px) {
            .invoice .top-left,.invoice .top-right,.invoice .payment-details {
                text-align:center;
            }

            .invoice .from,.invoice .to,.invoice .payment-details {
                float:none;
                width:100%;
                text-align:center;
                margin-bottom:25px;
            }

            .invoice p.lead,.invoice .from p.lead,.invoice .to p.lead,.invoice .payment-details p.lead {
                font-size:22px;
            }

            .invoice .btn {
                margin-top:10px;
            }
        }

        @media print {
            .invoice {
                width:900px;
                height:800px;
            }
        }
    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdeys">
<div class="row">
  <div class="col-sm-12">
	  	<div class="panel panel-default invoice" id="invoice">
		  <div class="panel-body">
			{{-- <div class="invoice-ribbon"><div class="ribbon-inner">PAID</div></div> --}}
		    <div class="row">
                <?php
                    $date=date_create( date('Y-m-d') );
                    $tgl = date_format($date,"d M Y");
                    $t = $data->gaji_pokok + $data->tunjangan + $data->bonus ;
                    $pjk = $t * 5 / 100 ;
                    $ttl = $t - $pjk;
                ?>
				<div class="col-sm-6 top-left">
					<i class="fa fa-rocket"></i>
				</div>

				<div class="col-sm-6 top-right">
						<h3 class="marginright">SlipGaji-{{ $data->id_gaji }}</h3>
						<span class="marginright">{{ $tgl }}</span>
			    </div>

			</div>
			<hr>
			<div class="row">

				<div class="col-xs-4 from">
					<p class="lead marginbottom">From : PT Sari Bumi Mulya</p>
                    <p>Jalan Tumapel, Pagetan, Kec. Singosari</p>
                    <p> Kabupaten Malang, Jawa Timur, 65153</p>
                    <p> No Telepon :  </p>
				</div>

				<div class="col-xs-4 to">
                    <p class="lead marginbottom">To : {{ $data->user->name }} </p>
                    <p>{{ $data->user->alamat }}</p>
                    <p>No Telp. {{ $data->user->hp }}</p>

			    </div>

			    <div class="col-xs-4 text-right payment-details">
					<p>Date: {{ $tgl }}</p>
                    <p>Total: Rp.{{ number_format($t, 2, ',', '.') }}</p>
                    <p>Jabatan:
                        @if ( $data->user->role == 3)
                            Owner
                        @elseif ( $data->user->role == 2)
                            Admin
                        @elseif ( $data->user->role == 0)
                            Petugas Kebun
                        @endif
                    </p>
			    </div>

			</div>

			<div class="row table-row">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th class="text-center" style="width:5%">No</th>
                        <th style="width:50%">Keterangan</th>
                        <th class="text-right" style="width:15%">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td>Gaji Pokok</td>
                        <td class="text-right">Rp. {{ number_format($data->gaji_pokok, 2, ',', '.') }}</td>
                      </tr>
                      <tr>
                        <td class="text-center">2</td>
                        <td>Tunjangan</td>
                        <td class="text-right">Rp. {{ number_format($data->tunjangan, 2, ',', '.') }}</td>
                      </tr>
                      <tr>
                        <td class="text-center">3</td>
                        <td>Bonus</td>
                        <td class="text-right">Rp. {{ number_format($data->bonus, 2, ',', '.') }}</td>
                      </tr>
                     </tbody>
                  </table>

			</div>

			<div class="row">
			<div class="col-xs-6 margintop">
			</div>
			<div class="col-xs-6 text-right pull-right invoice-total">
                <p>Subtotal : Rp.{{ number_format($t, 2, ',', '.')  }}</p>
                <p>Pajak Gaji (5%) : Rp. {{ number_format($pjk, 2, ',', '.')  }}</p>
                <p>Total : {{ number_format($ttl, 2, ',', '.')  }} </p>
			</div>
			</div>

		  </div>
		</div>
	</div>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
</body>
</html>
