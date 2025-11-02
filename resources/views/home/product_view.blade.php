<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               
             
               <div>
                  <form action="{{url('search_product')}}" method="GET">
                     @csrf
                     <input style="width: 500px;" type="text" name="search" placeholder="Search for something">
                     <input type="submit" value="search">
                  </form>

               </div>
            </div>

            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>

          @endif
            <div class="row">
            @foreach($product as $products)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details',$products->id)}}" class="option1">
                           Product Details
                           </a>
                           <form action="{{url('add_cart',$products->id)}}" method="POST" class="add-to-cart-form">
                           @csrf
                              <div class="row">
                                 <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" style="width: 100px;">
                                 </div>
                              
                              <div class="col-md-4">
                                 <input type="submit" value="Add to Cart" class="btn btn-primary add-to-cart-btn">
                              </div>
                           </div>
                            </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/{{$products->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$products->title}}
                        </h5>

                        @if($products->discount_price!=null)

                        <h6 style="color:red;">
                           Discount Price
                           <br>
                           {{$products->discount_price}}
                        </h6>

                        <h6 style="text-decoration: line-through; color:blue;">
                           Price
                           <br>
                           {{$products->price}}
                        </h6>
                        @else
                        
                        <h6 style="color:blue;">
                           Price
                           <br>
                           {{$products->price}}
                        </h6>
                        @endif
                       
                       
                     </div>
                  </div>
               </div>
            @endforeach

            <span style="padding-top: 20px;">
            {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
            </span>
             </div>
         </section>

            <!-- SweetAlert2: Show a centered success modal when Add to Cart is pressed -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
               document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
                  form.addEventListener('submit', function(e) {
                     // prevent immediate submission so we can show the modal
                     e.preventDefault();
                     var submitBtn = form.querySelector('input[type="submit"]');
                     if (submitBtn) submitBtn.disabled = true;

                     Swal.fire({
                        title: 'Success',
                        text: 'Product Added Successfully to Cart',
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 5000,
                        timerProgressBar: true,
                        willClose: () => {
                           // optional: could re-enable the button here if needed
                        }
                     }).then((result) => {
                        // result.isConfirmed -> user pressed OK
                        // result.dismiss === Swal.DismissReason.timer -> auto closed after timer
                        // submit the form in either case
                        form.submit();
                     });
                  });
               });
            });
            </script>