@extends('layouts.master')
@section('content')

<main>
    <!-- nav_area -->
    <section class="nav_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner_bottom_nav_area">
                        <ul class="d-flex align-items-center">
                            <li><a href="{{url('/all_stores')}}">All Stores</a></li>
                            <li><a href="{{url('/all_offers')}}">Offers</a></li>
                            <li><a href="{{url('/albalad_stores')}}">ALBalad Stores</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- nav_area_end -->


    <!-- my_account_page -->
    <div class="my_account_wrapper pt-60">
        <div class="container">
            <div class="row g-5">
                        
                @include('includes.client_sidebar')

                <div class="col-lg-9 col-md-8">
                    <div class="right_content_main_wrapper">
                        <!-- content_head -->
                        <div class="right_content_head">
                            <div class="stor_title_area d-flex justify-content-between mb-25">
                                <h1>Shipping Addresses</h1>
                            </div>
                        </div>
                        <!-- content_head -->


                        <!-- my_account_content_wrapper -->
                        <div class="my_account_content_wrap mt-55">
                            <div class="form_shipping_wrapper">
                                <div class="form_wrap d-flex justify-content-between flex-wrap">
                                    @if(session('error_msg'))
                                     <p class="alert alert-danger">{{session('error_msg')}}</p> 
                                    @endif
                                    @if(session('success_msg'))
                                     <p class="alert alert-success">{{session('success_msg')}}</p> 
                                    @endif
                                    <form method="post" action="{{url('/add_new_address')}}">
                                    @csrf
                                        <div class="single_myaccount_form my_account position-relative">
                                            <input type="text" required name="city" id="city">
                                            <label for="">City</label>
                                        </div>

                                        <div class="single_myaccount_form my_account position-relative">
                                            <input type="text" required name="address" id="address">
                                            <label for="">Address</label>
                                        </div>

                                        <div class="single_myaccount_textarea  position-relative">
                                            <textarea name="shipping_note" id="" cols="45" rows="13"></textarea>
                                            <label for="">Shipping note</label>
                                        </div>
                                        
                                        <div id="map" style="border:2px solid #222831; border-radius:20px;height: 400px; width: 200%;"></div>
                                        
                                        <input type="hidden" name="lat" id="lat">
                                        <input type="hidden" name="long" id="long">
                                        
                                        <div class="save_address_btns mt-30">
                                            <button class="" type="submit">Save address</button>
                                        </div>

                                    </form>
                                
                                </div>
                            </div>


                        </div>
                        <!-- my_account_content_wrapper -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- my_account_page_end -->
</main>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMlR4YuYz3KMPmTmOXSwQc7p6IS-a19Bs&v=3.exp&libraries=places"></script>
<script>
    $(function() {
        $("#CustomerAddresses").addClass("active");
    });
</script>
<script>

    $(function(){
        
        var map;
	    var previousMarker;
	    var first = true;
	    var lat;
	    var long;
	    var input;
	    var autocomplete;
	    var place;

	    getLocation();

	    function getLocation() {
	        if (navigator.geolocation) {
	            navigator.geolocation.getCurrentPosition(
	                showPosition, 
	                null, 
	                {
	                   enableHighAccuracy: true,
	                   timeout: 5000,
	                   maximumAge: 0
	                });
	        } else {
	            x.innerHTML = "Geolocation is not supported by this browser.";
	        }
	    }

	    function showPosition(position) {
	        lat =  position.coords.latitude; 
	        long = position.coords.longitude;
	        myMap(lat, long)
	    }


	    function toggleBounce() {
	        if (marker.getAnimation() !== null) {
	          marker.setAnimation(null);
	        } else {
	          marker.setAnimation(google.maps.Animation.BOUNCE);
	        }
	      }

	    function myMap(x, y){
	        var uluru = {lat: x, lng: y};
	        
	        map = new google.maps.Map(document.getElementById('map'), {zoom: 18, center: uluru});
	        if(first){
	            previousMarker = new google.maps.Marker({
	                position: uluru,
	                map: map
	            });
	            first = false;
	            getDirections();
	        }
	        map.addListener('click', function(e) {
	            latLng = e.latLng;
	            lat = e.latLng.lat();
	            long = e.latLng.lng();
	            $('#lat').val(lat);
	            $('#long').val(long);
	            getDirections();

	            previousMarker.setMap(null);
	            previousMarker = new google.maps.Marker({
	                position: latLng,
	                map: map
	            });
	        });
	    }

	    function centerMarker(){
	        if ((!map.getBounds().contains(previousMarker.getPosition()))) { //Note the double &  
	            map.setCenter(previousMarker.getPosition());  
	        }
	    }

	    getDirections=async()=>{
	        try {
	          let resp = await axios.get(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${long}&sensor=true&key=AIzaSyDMlR4YuYz3KMPmTmOXSwQc7p6IS-a19Bs`)
	          let respJson = resp;
	          if(respJson.status=='ZERO_RESULTS'){
	            alert('Network Error in Getting Place Name');
	          }
	          else{
	           $('#address').val(respJson.data.results[0].formatted_address);
               var str = respJson.data.results[8].formatted_address;
               var ret = str.split(",");
               var str1 = ret[0];
               var str2 = ret[1];
               $('#city').val(str1);
	          }
	        } 
	        catch(error) {
	            alert('Error Using Maps. Please Try Again');
	        }
	    }
	})

</script>
@endpush