@extends('layout1')
@section('content')
	<div class="customer_login">
					<div class="row">
						<div>
						<p>Vui lòng sử dụng Đăng ký và Thanh toán để dễ dàng truy cập vào lịch sử đơn đặt hàng của bạn hoặc sử dụng 
                    Thanh toán với tư cách Khách</p>
						</div>
						<!--login area start-->
						
						<div class="col-lg-offset-3 col-md-offset-3" >
							<div class="account_form">
								<h2>Hóa đơn thanh toán</h2>					
								<form  method="POST">
                                {{csrf_field()}}
									<label>Email   <span>*</span></label>		
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Email*" required>
									<label>Họ và tên   <span>*</span></label>		
									<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên *" required>
									<label>Số điện thoại   <span>*</span></label>		
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại" required>
									<label>Địa chỉ   <span>*</span></label>		
									<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ *" required>
                                    <label>Ghi chú   <span>*</span></label>		
                                    <textarea name="shipping_notes" class="shipping_notes"  placeholder="Nội dung ghi chú" rows="8"></textarea>
									
									<select name="payment_method" class="payment_method"> 
										<option value="1"> Thanh toán thẻ bằng tín dụng</option>													
										<option value="2"> Thanh toán bằng tiền mặt</option>									
										<option value="3"> Thanh toán bằng creditcard</option>
									</select>
									<p></p>
									
							        <input type="button"  value="Gửi" name="send_order" class="btn btn-primary send_order"></button>
												           	
                  				  </form>
							</div>    
						</div>
						<!--login area start-->					
					</div>
				</div>
				
@endsection