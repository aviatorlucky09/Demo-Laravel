
<div class="col-md-8">
	<input type="hidden" name="latitude" id="latitude"/>
	<input type="hidden" name="longitude" id="longitude"/>
	<label class="col-form-label">Address</label>
	<input type="text" class="form-control" name="address" id="autoaddress"
	value="{{ $obj->address }}"/>	
</div>
<div class="col-md-3">
	<br>
	<a id="find" class="btn btn-success text-white mt-3">Find</a>
</div>
<div class="col-md-4">
	<label class="col-form-label">Postal Code</label>
	<input name="postal_code" type="text"  class="form-control"
	value="{{ $obj->zipcode }}">
</div>	
<div class="col-md-12 map_canvas my-3" style="height:250px;"></div>		

<script>
	$(function(){
		$("#autoaddress").geocomplete({
			map: ".map_canvas",
			details: "form",
			markerOptions: {
				draggable: true,
				zoom: 14,
			}
		});
		$("#autoaddress").bind("geocode:result", function(event, results){
			$("#latitude").val(results.geometry.location.lat());
			$("#longitude").val(results.geometry.location.lng());
		});
		$("#autoaddress").bind("geocode:dragged", function(event, latLng){
			$("#latitude").val(latLng.lat());
			$("#longitude").val(latLng.lng());
		});
		var lat_and_long = "{{ $obj->latitude }},{{ $obj->longitude}}";
		$("#autoaddress").geocomplete("find", lat_and_long);
		$("#find").click(function(){
			$("#autoaddress").trigger("geocode");
		});

	}); 

</script>
