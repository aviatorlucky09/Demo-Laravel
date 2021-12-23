
<div class="col-md-8">
	<input type="hidden" name="latitude" id="latitude"/>
	<input type="hidden" name="longitude" id="longitude"/>
	<label class="col-form-label">Address</label>
	<input type="text" class="form-control" name="address" id="autoaddress"
	value="{{ $boat->address }}"/>	
</div>
<div class="col-md-3">
	<br>
	<a id="find" class="btn btn-success text-white mt-3">Find</a>
</div>
<div class="col-md-4">
	<label class="col-form-label">Postal Code</label>
	<input name="postal_code" type="text"  class="form-control"
	value="{{ $boat->zipcode }}">
</div>			

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
		var lat_and_long = "{{ $boat->latitude }},{{ $boat->longitude}}";
		$("#autoaddress").geocomplete("find", lat_and_long);
		$("#find").click(function(){
			$("#autoaddress").trigger("geocode");
		});

	}); 

</script>
