<table width="300" cellpadding="5" borderpadding="0" style="border: 1px solid #000; font-family: sans-serif;">
	<tr>
		<td style="width: 10%">
			<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->errorCorrection('H')
                        ->generate($order->order_number)) !!} ">
		</td>
		<td style="line-height: 24px">
			<strong style="font-size: 24px">LOKALDATPH</strong><br>
			<strong style="font-size: 18px">{{$order->order_number}}</strong><br>
			<strong>Delivery Receipt</strong>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding:5px;padding-top:10px;padding-bottom: 10px;">
			<table width="100%" cellpadding="0" style="padding:3px;border:solid 1px #000000">
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">
						<img style="width: 20px" src="data:image/png;base64,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">
						<strong>Receiver</strong>
					</td>
				</tr>
				<tr>
					<td colspan="2">To : {{$order->userFullName}}</td>
				</tr>
				<tr>
					<td colspan="2">
						{{strtoupper($order->userShippingAddress)}}
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">
						<img style="width: 20px" src="data:image/png;base64,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">
						<strong>Shipper</strong>
					</td>
					
				</tr>
				<tr>
					<td colspan="2">FROM : {{$sellers->name}}</td>
				</tr>
				<tr>
					<td colspan="2">
						{{strtoupper($sellers->street_address.', '.$sellers->brgyDesc.', '.$sellers->citymunDesc.', '.$sellers->provDesc)}}
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td>Items :</td>
					<td style="text-align: right;">Shirt(s)</td>
				</tr>
				
				<tr>
					<td>Mode :</td>
					<td style="text-align: right"><strong>{{strtoupper($order->payment_method)}}</strong></td>
				</tr>
				<tr>
					<td colspan="2">
						Payable Amount :
						<span style="float: right;font-weight: bold;font-size: 24px">PHP&nbsp;{{number_format($order->order_amount_due, 2)}}</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
			
		</td>
	</tr>
	<tr>
		<td colspan="2" style="font-weight: bold">
			For returns, send us an email to:<br>
			support@lokaldatph.com
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;font-weight: bold">
			www.lokaldatph.com
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;color:gray">
			Print
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>