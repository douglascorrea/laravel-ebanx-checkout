@extends('layout')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="board">
                    <div class="board-inner">
                        <ul class="nav nav-tabs" id="checkout_process">
                            <div class="liner"></div>
                            <li class="active">
                                <a href="#shopping_cart" data-toggle="tab" title="Shopping Cart">
                                    <span class="round-tabs one">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </span> 
                                </a></li>

                            <li class="disabled"><a href="#registration" data-toggle="tab" title="Registration">
                                <span class="round-tabs two">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span> 
                            </a>
                            </li>
                            <li class="disabled"><a href="#payment" data-toggle="tab" title="Payment Details">
                                <span class="round-tabs three">
                                    <i class="glyphicon glyphicon-credit-card "></i>
                                </span> </a>
                            </li>

                            <li class="disabled"><a href="#order_confirmed" data-toggle="tab" title="Order Confirmed">
                                <span class="round-tabs five">
                                    <i class="glyphicon glyphicon-ok"></i>
                                </span> </a>
                            </li>
                            
                        </ul></div>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="shopping_cart">
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="panel panel-info">
				                                <div class="panel-heading">
					                                  <div class="panel-title">
						                                    <div class="row">
							                                      <div class="col-xs-6">
								                                        <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
							                                      </div>
							                                      <div class="col-xs-6">
								                                        <a href="/" type="button" class="btn btn-primary btn-sm btn-block">
									                                          <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
								                                        </a>
							                                      </div>
						                                    </div>
					                                  </div>
				                                </div>
				                                <div class="panel-body">
                                            @foreach($items as $item)
                                                <div class="row cart-item" id="{{ $item->rowId }}">
						                                        <div class="col-xs-2"><img class="img-responsive" src="img/{{ $item->model->image_url }}">
						                                        </div>
						                                        <div class="col-xs-4">
							                                          <h4 class="product-name"><strong>{{ $item->model->name }}</strong></h4><h4><small>{{ $item->model->description }}</small></h4>
						                                        </div>
						                                        <div class="col-xs-6">
							                                          <div class="col-xs-6 text-right">
								                                            <h6><strong>{{ $item->model->price }} <span class="text-muted">x</span></strong></h6>
							                                          </div>
							                                          <div class="col-xs-4">
								                                            <input type="text" class="form-control input-sm cart-qty" value="{{ $item->qty }}">
							                                          </div>
							                                          <div class="col-xs-2">
								                                            <button type="button" class="btn btn-link btn-xs remove-item ladda-button" data-style="zoom-in" data-color="red" data-spinner-color="red" href="/cart/remove/{{ $item->rowId }}">
									                                              <span class="glyphicon glyphicon-trash " > </span>
								                                            </button>
							                                          </div>
						                                        </div>
					                                      </div>
					                                      <hr>
                                            @endforeach
					                                  <div class="row">
						                                    <div class="text-center">
							                                      <div class="col-xs-9">
								                                        <h6 class="text-right">Added items?</h6>
							                                      </div>
							                                      <div class="col-xs-3">
								                                        <button type="button" id="update-cart" class="btn btn-default btn-sm btn-block ladda-button" data-style="expand-right" data-spinner-color="blue" href="/cart/update">
									                                          Update cart
								                                        </button>
							                                      </div>
						                                    </div>
					                                  </div>
				                                </div>
				                                <div class="panel-footer">
					                                  <div class="row text-center">
						                                    <div class="col-xs-9">
							                                      <h4 class="text-right">Total <strong> <span id="cart-total">{{ Cart::total() }}</span></strong></h4>
						                                    </div>
						                                    <div class="col-xs-3">
                                                    <button href="#registration" id="goto_registration" class="btn-submit btn btn-success btn-block"> Checkout <span style="margin-left:10px;" class="glyphicon glyphicon-barcode"></span></button>
                                                </div>
					                                  </div>
				                                </div>
			                              </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="registration">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="head text-center">Please fill the form below:</h3>
                                    <form class="form-horizontal" name="registration_form" id="registration-form" role="form">
                                        <div class="form-group">
                                            <label for="country" class="col-sm-2 control-label">Country</label>
                                            <div class="col-sm-9">
                                                <select data-validation="required" name="country" id="country" class="form-control" autofocus>
                                                    <option value="">Select</option>
                                                    <option value="br">Brazil</option>
                                                    <option value="mx">Mexico</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firstName" class="col-sm-2 control-label">Full Name</label>
                                            <div class="col-sm-9">
                                                <input data-validation="required" type="text" name="name" id="firstName" placeholder="Full Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input data-validation="email" type="email" id="email" name="email" placeholder="Email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group brazil">
                                            <label for="document" class="col-sm-2 control-label" >Document</label>
                                            <div class="col-sm-9">
                                                <input data-validation="cpf" type="text" id="document" name="document" placeholder="Document" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group brazil">
                                            <label for="birthDate" class="col-sm-2 control-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <input data-validation="birthdate" data-validation-format="dd/mm/yyyy" type="text" id="birthDate" class="form-control" name="birth_date">
                                                <span id="helpBlock" class="help-block">Format: dd/mm/yyyy</span>
                                            </div>
                                        </div>
                                        <div class="form-group brazil">
                                            <label for="address" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-9">
                                                <input data-validation="required" type="text" name="address" id="address" placeholder="Address" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group brazil">
                                            <label for="street_number" class="col-sm-2 control-label">Number</label>
                                            <div class="col-sm-2">
                                                <input data-validation="required" type="text" id="street_number" name="street_number" placeholder="Number" class="form-control">
                                            </div>
                                            <label for="zipcode" class="col-sm-2 control-label brazil">Zipcode</label>
                                            <div class="col-sm-4">
                                                <input data-validation="required" type="text" id="zipcode" name="zipcode" placeholder="Zipcode" class="form-control">
                                            </div>

                                        </div>
                                        <div class="form-group brazil">
                                            <label for="city" class="col-sm-2 control-label">City</label>
                                            <div class="col-sm-2">
                                                <input data-validation="required" type="text" id="city" placeholder="City" name="city" class="form-control">
                                            </div>
                                            <label for="state" class="col-sm-2 control-label">State</label>
                                            <div class="col-sm-4">
                                                <select data-validation="required" id="state" class="form-control" name="state">
	                                                  <option value="">Select</option>
	                                                  <option value="AC">Acre</option>
	                                                  <option value="AL">Alagoas</option>
	                                                  <option value="AP">Amapá</option>
	                                                  <option value="AM">Amazonas</option>
	                                                  <option value="BA">Bahia</option>
	                                                  <option value="CE">Ceará</option>
	                                                  <option value="DF">Distrito Federal</option>
	                                                  <option value="ES">Espirito Santo</option>
	                                                  <option value="GO">Goiás</option>
	                                                  <option value="MA">Maranhão</option>
	                                                  <option value="MS">Mato Grosso do Sul</option>
	                                                  <option value="MT">Mato Grosso</option>
	                                                  <option value="MG">Minas Gerais</option>
	                                                  <option value="PA">Pará</option>
	                                                  <option value="PB">Paraíba</option>
	                                                  <option value="PR">Paraná</option>
	                                                  <option value="PE">Pernambuco</option>
	                                                  <option value="PI">Piauí</option>
	                                                  <option value="RJ">Rio de Janeiro</option>
	                                                  <option value="RN">Rio Grande do Norte</option>
	                                                  <option value="RS">Rio Grande do Sul</option>
	                                                  <option value="RO">Rondônia</option>
	                                                  <option value="RR">Roraima</option>
	                                                  <option value="SC">Santa Catarina</option>
	                                                  <option value="SP">São Paulo</option>
	                                                  <option value="SE">Sergipe</option>
	                                                  <option value="TO">Tocantins</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number"  class="col-sm-2 control-label" >Phone Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" data-validation="required" id="phone_number" placeholder="Phone Number" class="form-control" name="phone_number">
                                            </div>
                                        </div>
                                        <div class="form-group" style="padding-bottom: 60px; margin-top: 30px;">
                                            <div class="col-sm-9 col-sm-offset-2">
                                                <button type="submit" href="#messages" class="btn-submit btn btn-success btn-block" id="goto_payment" disabled="disabled"> Choose Payment Method <span style="margin-left:10px;" class="glyphicon glyphicon glyphicon-credit-card"></span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payment">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="head text-center">Please fill payment details:</h3>
                                    <div class="alert alert-danger alert-dismissible hide" id="payment-error" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Ooops!</strong> <span id="payment-error-message">Better check yourself, you're not looking too good.</span>
                                    </div>
                                    <form class="form-horizontal" name="payment_method_form" id="payment-method-form" role="form">
                                        <div class="form-group">
                                            <label for="payment_method" class="col-sm-2 control-label">Payment Method</label>
                                            <div class="col-sm-9">
                                                <select id="payment_method" data-validation="required" class="form-control" name="payment_method">
                                                </select>
                                            </div>
                                        </div>
                                        <div id="credit_card_payment">
                                            <div class="form-group">
                                                <label for="credit_card" class="col-sm-2 control-label">Credit Card</label>
                                                <div class="col-sm-9">
                                                    <select id="credit_card" data-validation="required" class="form-control" name="credit_card">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_holder_name" class="col-sm-2 control-label">Card Holder's Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" data-validation="required" id="card_holder_name" placeholder="Card Holder's Name" name="card_holder_name" class="form-control" autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_number" class="col-sm-2 control-label" >Card Number</label>
                                                <div class="col-sm-4">
                                                    <input type="text" id="card_number" placeholder="Card Number" data-validation="creditcard" data-validation-allowing="visa, mastercard, amex, diners_club, discover, maestro, cjb" class="form-control" name="card_number">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" id="cvv" placeholder="CVV" data-validation="cvv"  class="form-control" name="cvv">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="valid_month" class="col-sm-2 control-label">Expiration Date</label>
                                                <div class="col-sm-6">
                                                    <input data-validation="date" data-validation-format="mm/yyyy" type="text" id="due_date" class="form-control" name="due_date">
                                                    <span id="helpBlock" class="help-block">Format: mm/yyyy</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" style="padding-bottom: 60px; margin-top: 30px;">
                                            <div class="col-sm-9 col-sm-offset-2">
                                                <button class="btn btn-success btn-block" id="confirm_payment"> Confirm Payment <span style="margin-left:10px;" class="glyphicon glyphicon glyphicon-credit-card"></span></a>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="order_confirmed">
                            <div class="text-center">
                                <i class="img-intro icon-checkmark-circle"></i>
                            </div>
                            <div class="final-portugues hide">
                                <h3 class="head text-center">Obrigado por comprar com a gente! Nós <span style="color:#f48260;">♥</span> programar. E também falamos português!</h3>
                                <p class="narrow text-center credit-card-message hide">
                                    Seu livro já está a caminho! Se você gostou da experiência mande um feedback para me@douglascorrea.io ;) (E me deixa trabalhar no Ebanx ;) )
                                </p>
                                <p class="narrow text-center boleto-message hide">
                                    Quase lá! Agora só falta você pagar <a href="" id="url-boleto">esse boleto aqui ó!</a>
                                </p>
                            </div>
                            <div class="final-espanol hide">
                                <h3 class="head text-center">Gracias por comprar con nosotros! Aqui programamos con <span style="color:#f48260;">♥</span>. Y tambien hablamos español!</h3>
                                <p class="narrow text-center credit-card-message hide">
                                    Su libro ya esta a camino de su casa! Si te gustó esta experiencia, enviame un correo a me@douglascorrea.io ;) (Y claro, aceptame para trabalhar en Ebanx ;) )
                                </p>
                                <p class="narrow text-center boleto-message hide">
                                    Ya casi! Solo falta pagar <a href="" id="url-oxxo"> este Oxxo aqui!</a> y ya!
                                </p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    
@stop

@section('header')
    <style>
     @import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);
     .board{
         width: 75%;
         margin: 60px auto;
         background: #fff;
     }
     .board .nav-tabs {
         position: relative;
         margin: 40px auto;
         margin-bottom: 0;
         box-sizing: border-box;

     }

     .board > div.board-inner{
         background: #fafafa;
         background-size: 30%;
     }

     p.narrow{
         width: 60%;
         margin: 10px auto;
     }

     .liner{
         height: 2px;
         background: #ddd;
         position: absolute;
         width: 80%;
         margin: 0 auto;
         left: 0;
         right: 0;
         top: 50%;
         z-index: 1;
     }

     .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
         color: #555555;
         cursor: default;
         border: 0;
         border-bottom-color: transparent;
     }

     span.round-tabs{
         width: 70px;
         height: 70px;
         line-height: 70px;
         display: inline-block;
         border-radius: 100px;
         background: white;
         z-index: 2;
         position: absolute;
         left: 0;
         text-align: center;
         font-size: 25px;
     }

     span.round-tabs.one{
         color: rgb(34, 194, 34);border: 2px solid rgb(34, 194, 34);
     }

     li.active span.round-tabs.one{
         background: #fff !important;
         border: 2px solid #ddd;
         color: rgb(34, 194, 34);
     }

     span.round-tabs.two{
         color: #febe29;border: 2px solid #febe29;
     }

     li.active span.round-tabs.two{
         background: #fff !important;
         border: 2px solid #ddd;
         color: #febe29;
     }

     span.round-tabs.three{
         color: #3e5e9a;border: 2px solid #3e5e9a;
     }

     li.active span.round-tabs.three{
         background: #fff !important;
         border: 2px solid #ddd;
         color: #3e5e9a;
     }

     span.round-tabs.four{
         color: #f1685e;border: 2px solid #f1685e;
     }

     li.active span.round-tabs.four{
         background: #fff !important;
         border: 2px solid #ddd;
         color: #f1685e;
     }

     span.round-tabs.five{
         color: #999;border: 2px solid #999;
     }

     li.active span.round-tabs.five{
         background: #fff !important;
         border: 2px solid #ddd;
         color: #999;
     }

     .nav-tabs > li.active > a span.round-tabs{
         background: #fafafa;
     }
     .nav-tabs > li {
         width: 25%;
     }
     /*li.active:before {
         content: " ";
         position: absolute;
         left: 45%;
         opacity:0;
         margin: 0 auto;
         bottom: -2px;
         border: 10px solid transparent;
         border-bottom-color: #fff;
         z-index: 1;
         transition:0.2s ease-in-out;
     }*/
     li:after {
         content: " ";
         position: absolute;
         left: 45%;
         opacity:0;
         margin: 0 auto;
         bottom: 0px;
         border: 5px solid transparent;
         border-bottom-color: #ddd;
         transition:0.1s ease-in-out;
         
     }
     li.active:after {
         content: " ";
         position: absolute;
         left: 45%;
         opacity:1;
         margin: 0 auto;
         bottom: 0px;
         border: 10px solid transparent;
         border-bottom-color: #ddd;
         
     }
     .nav-tabs > li a{
         width: 70px;
         height: 70px;
         margin: 20px auto;
         border-radius: 100%;
         padding: 0;
     }

     .nav-tabs > li a:hover{
         background: transparent;
     }

     .tab-content{
     }
     .tab-pane{
         position: relative;
         padding-top: 0;
     }
     .tab-content .head{
         font-family: 'Roboto Condensed', sans-serif;
         font-size: 25px;
         text-transform: uppercase;
         padding-bottom: 10px;
     }
     .btn-outline-rounded{
         padding: 10px 40px;
         margin: 20px 0;
         border: 2px solid transparent;
         border-radius: 25px;
     }

     .btn.green{
         background-color:#5cb85c;
         color: #ffffff;
     }


     @media( max-width : 585px ){
     
     .board {
         width: 90%;
         height:auto !important;
     }
     span.round-tabs {
         font-size:16px;
         width: 50px;
         height: 50px;
         line-height: 50px;
     }
     .tab-content .head{
         font-size:20px;
     }
     .nav-tabs > li a {
         width: 50px;
         height: 50px;
         line-height:50px;
     }

     li.active:after {
         content: " ";
         position: absolute;
         left: 35%;
     }

     .btn-outline-rounded {
         padding:12px 20px;
     }
     }

    </style>
@stop


