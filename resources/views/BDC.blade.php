
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>

		<style>
            @font-face {
                font-family: 'NouvelRBold';
                src: url('{{ asset("webStyle/assets/fonts/NouvelRBold.ttf") }}') format('woff2');
            }

            @font-face {
                font-family: 'NouvelRRegular';
                src: url('{{ asset("webStyle/assets/fonts/NouvelRRegular.ttf") }}') format('woff2');
            }

			body{
				margin: 0;
			}
			.invoice-box {
				width: 100%;
			}

			.invoice-box table {
				width: 100%;
				line-height: 19px;
				text-align: left;
			}

			.invoice-box table td {
				padding: 0px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td p.textleft{
				text-align:left;
				margin-left: 50px ;
			
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}

            .titleBDC{
                font-family: 'NouvelRBold';
				color: rgb(0, 41, 118);
				font-size: 24px;
				margin: 0px;
            }
            
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td>
						<p class="titleBDC">OFFRE COMMERCIALE<br><span style="font-size:15px;color:black;">REFERENCE CAR AGENT DACIA</span></span></p>
					</td>
					<td class="title">
						<img src={{ $imageSrc }} style="width: 100%; max-width: 250px;" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<p style="font-size: 14px;text-align: left;margin-left: 50px;">Le {{ date('d / m / Y') }}</span></p>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<p>
										<span style="font-weight: 100;font-size: 14px;">Conseiller(ère) commercial(e) :</span> 
										<span> ANAS HARTI</span><br />
										N° GSM :
								    </p>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td class="titleBDC">CLIENT</td>
                    <td></td>
				</tr>
				<tr class="item">
					<td>Type :Particulier</td>
					<td></td>
				</tr>
                <tr class="item">
					<td><p >Nom <br><span style="font-weight: 100;font-size: 14px;">{{$user->name}}</span></p></td>
					<td><p class="textleft">Prénom <br><span style="font-weight: 100;font-size: 14px;">{{$user->prenom}}</span></p></td>
					
				</tr>
				<tr class="item">
					<td><p >Adresse <br><span style="font-weight: 100;font-size: 14px;">{{$user->ville}}</span></p></td>
					<td><p class="textleft"> Portable <br><span style="font-weight: 100;font-size: 14px;">{{$user->tele}}</span></p></td>
				</tr>
				<tr class="item">
					<td><p > Téléphone Pro <br></p></td>
					<td><p class="textleft">  Téléphone Privé <br></p></td>
				</tr>
				<tr class="item">
					<td><p > Fax <br></span></p></td>
					<td><p class="textleft">  E-mail <br><span style="font-weight: 100;font-size: 14px;">{{$user->email}}</span></p></td>
				</tr>
                <tr class="item">
					<td></td>
				</tr>
				<tr class="item">
					<td><p style="font-size:20px" >{{$modele->nommodele}} {{$version->nomversion}} <br></span></p></td>
					<td><p class="textleft" > Prix TTC : <span style="font-weight: 100;font-size: 14px;">{{$commande->total}} MAD</span></p></td>
				</tr>
				 @if($simulation)
				<tr class="item">
					<td><p > Mode de règlement :<span style="font-weight: 100;font-size: 14px;"> Crédit</span></p></td>
					<td><p class="textleft" >Apport :<span style="font-weight: 100;font-size: 14px;"> {{$simulation->apport}} % </span><br>
					Mensualité : <span style="font-weight: 100;font-size: 14px;">{{$simulation->mensualite}} MAD</span><br>
					Période :<span style="font-weight: 100;font-size: 14px;"> {{$simulation->durree}} </span><br>
					Frais de dossier :<span style="font-weight: 100;font-size: 14px;"> {{$simulation->fraisdossier}} MAD</span><br>
					<br></span></p></td>
				</tr>
				 @else
                    <tr class="heading">
                        <td class="titleBDC">Mode de règlement : <span style="font-weight: 100;font-size: 14px;">Comptant </span></td>
                        <td></td>
                    </tr>
                @endif

				<tr>
					<td>
						<div style="border: 1px solid;padding: 31px 20px 87px;margin: 0 20px 0 0;"> Signature du Client</div>
					</td>
					
					<td>
						<div style="border: 1px solid;padding: 31px 20px 87px;" >  Signature du Conseiller(ère) commercial(e)</div>
					</td>
				</tr>

			</table>

            <p style="font-size: 8px;line-height: 1.5;margin-top: 50px;">
                « Conformément à la Loi Marocaine (Dahir n° 1.09.15 du 18 février 2009 portant promulgation de la loi 09.08 relative à la protection des personnes physiques à l’égard du traitement des
                données à caractère personnel / Dahir n° 1-11-03 du 18 février 2011 portant promulgation de la loi n° 31-08 édictant des mesures de protection du Consommateur) vous disposez d’un
                droit d’accès, de rectification et d’opposition aux données vous concernant et à leur traitement. Si vous souhaitez exercer ce droit ou ne plus recevoir de communication de notre part,
                contactez-nous par courrier à l’adresse postale suivante : Direction Marketing - RENAULT COMMERCE MAROC, 44 Avenue Khalid Ibnou El Oualid, Ain Sbaa, Casablanca, ou à ’adresse électronique suivante : crm@renault.com »
            </span></p>
		</div>
	</body>
</html>