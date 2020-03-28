<!DOCTYPE html>
<html>

<head>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title> Invoice</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="{{asset('public/bootstrap.css')}}" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="{{asset('public/custom-style.css')}}" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    
    <style type="text/css">
   body{
       font-family: Tahoma, Verdana, Segoe, sans-serif;
	font-style: normal;
	font-variant: normal;
   }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        table.tblStyle1 {
            font-family: Tahoma, Verdana, Segoe, sans-serif;
	font-style: normal;
	font-variant: normal;
            font-size:7px;
            height:350px;
            min-height:450px!important;
            padding:0px!important;
            margin:0px!important;
           
        }
        table.tblStyle1 tr{
            padding:0px!important;
            margin:0px!important;
            height:15px!important;
            border-collapse: collapse;
           
        }
        table.items {
    border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
    border-left: 0.1mm solid #000000;
    border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
    text-align: center;
    border: 0.1mm solid #000000;
    font-variant: small-caps;
}
.items td.blanktotal {
    background-color: #EEEEEE;
    border: 0.1mm solid #000000;
    background-color: #FFFFFF;
    border: 0mm none #000000;
    border-top: 0.1mm solid #000000;
    border-right: 0.1mm solid #000000;
}
.items td.totals {
    text-align: right;
    border: 0.1mm solid #000000;
}
 .total{
    text-align: right;
    border: 0.1mm solid #000000;
}
.items td.cost {
    text-align: "." center;
}
    </style>
</head>

<body>

    <div class="container" >

        <table>
            <tr>
                <td width="180px">
                    <img src="logo.jpg" width="100" />
                </td>

                <td colspan="6">
                    <center style="font-size:20px;"><strong>TOKA INK BANGLADESH LIMITED</strong></center>
                    <center> 2 D.I.T.Avenue(Extension) 2nd Floor</center>

                    <center>Motijheel Commercial Area </center>

                    <center>Dhaka-1000</center>

                    
                </td>
            </tr>
        </table> 
        <center style="font-size:17px;"><strong>Bill / Invoice</strong></center> 
        <table border="0px" border-spacing="" style="text-align:center!important;">
            
            <tr>
                <td width="382px" style="text-align:left!important;">

                    <u><strong>Bill Information</strong></u><br/>
                     Order No : {{$bill_details->order_no}}<br />
                   
                    Bill No : {{$bill_details->bill_no}}
                    <br /> Bill Date : {{$bill_details->bill_date}}
                   
                </td>
                <td width="310px" style="text-align:right!important;">
                    <u><strong>Customer Information</strong></u>
                    <br/> {{$bill_details->name}}
                    <br /> {{$bill_details->address}} <br /> 
                </td>
                
            </tr>
            
        </table>
        
        
        <?php $sl_no=0;?>
            <div class="row" >
                <div class="" >
                    <div class="" >
                        <table class="items" style="font-size: 12pt; border-collapse: collapse;" cellpadding="3">
                            
                                <tr >
                                                    
                                    <td width="50px" class="text-left">Sl.#</td>
                                    <td width="300px" class="text-left">Product Name</td>
                                    <td width="50px" class="text-center">Qnty</td>
                                    <td width="100px" class="text-center">Unit Price</td>
                                    <td width="170px" class="text-right">Amount</td>
                                </tr>
                            
                        </table>
                        <table class="items"  style=" min-height:650px; font-size: 9pt; border-collapse: collapse; " cellpadding="3">
                            
                                <?php  $qty=0;$total_rows=25;$current_row=0;?>
                                
                                @foreach($product as $product)
                                <tr>
                                    <td width="50px" class="text-left" valign="top">{{$sl_no=$sl_no+1}} </td>
                                    <td width="300px" class="text-left" valign="top">{{$product->title}}</td>
                                    <td width="50px" class="text-center" valign="top"> {{($product->quantity)}} {{($product->unit)}}</td>
                                    <td width="100px" class="text-center" valign="top"> {{($product->selling_price) }}/{{($product->unit)}}</td>
                                    <td width="170px" class="text-right" valign="top">
                                        {{number_format($product->selling_price1,2)}}
                                    </td>
                                </tr>
                                <?php 
                                if($product->unit =='kg')
                                $qty= $qty+$product->quantity*2.2046;
                                else
                                $qty= $qty+$product->quantity;
                                
                                $current_row = $current_row+1;?>
                                @endforeach
                                <!--   EMPTY ROW    -->
                                    <?php
                                    if($current_row < $total_rows){
                                        for($i=$current_row; $i<$total_rows; $i++){
                                           echo '<tr>
                                           <td  width="50px" class="text-left" valign="top"> &nbsp;</td>
                                    <td  width="50px" class="text-left" valign="top">&nbsp;</td>
                                    <td  width="50px" class="text-left" valign="top">&nbsp;</td>
                                    <td  width="50px" class="text-left" valign="top">&nbsp;</td>
                                    <td  width="50px" class="text-left" valign="top"> &nbsp;</td>
                                    
                                           </tr>';
                                        }
                                    }
                                    ?>
                                    
                                    
                                    <!--  END EMPTY ROW    -->
                                     <tr>
                                  <td class="text-right total" colspan="1">&nbsp; </td>
                                    <td colspan="2" class="text-right total"><strong>Total Quantity : {{$qty}}Lb. </strong></td>
                                  <td class="text-right total" colspan="2"><strong>Total Amount : {{number_format($bill_details->total_amt,2)}}</strong></td>
                                </tr>
                        </table>
                    </div>
                    <table   style="border-collapse: collapse;" >
                        <tr style="text-align:right;" ><br>
                            <td style="width:300px;">&nbsp;</td>
                            <td class="pull-right"   style="text-align: right;padding:5px;margin-left:500px;" width="300px;">
                                        
                                        <br>
                                        Discount (%) :    <br>
                                       Discount(Tk) :    <br>
                                        Less Amount :   <br>
                                        Bill Amount :  <br>
                                        
                            </td>
                           <td class="pull-left"   style="text-align: right;padding:5px;">
                               <br>
                                        <strong>  {{$bill_details->dis_percent}}% </strong><br>
                                        <strong> {{number_format($bill_details->total_amt*$bill_details->dis_percent/100,2)}}  </strong><br>
                                         <strong> {{number_format($bill_details->less_amt,2)}}  </strong><br>
                                      <strong> {{number_format($bill_details->net_amt,2)}}  </strong><br>

                            </td>

                           
                        </tr>
                    </table>
                    

                </div>
                

            </div>
            
                <div class="row">

                    <div class="text-right col-lg-12 col-md-12 col-sm-12" style="">
                        <div class="row text-center contact-info">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                         <span>Challan No : @foreach($challan_no as $challan_no1 ) @foreach($challan_no1 as $challan_no )
                                            {!! $challan_no !!} @endforeach | @endforeach</span><br/>
                    </div>
                </div>
                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                        <br/><br/><br/>
                        <strong>Mg. Director/ Director / Manager</strong>
                        
                    </div>
                </div>
    </div>
    
</body>

</html>