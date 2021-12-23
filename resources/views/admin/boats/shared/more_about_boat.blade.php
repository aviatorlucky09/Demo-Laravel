<div class="col-md-12 row pt-3">
  <label class="col-form-label h4 text-dark">More About Boat</label>
</div>   
<div class="col-md-12 row">
 <hr>
</div>
<div class="col-md-12 row">
	<label class="col-form-label">Rental Season for the Vessel</label>
</div>
<div class="col-md-12">
	<div class="col-md-8 row">
		<div class="col-md-4">
			<label class="col-form-label">Rental season start </label>
			<input type="text" class="form-control" name="rental_season_start" id="rental_season_start" 
			value="{{ visibleDateFormat($boat->detail->rental_season_start) }}"/>
		</div>
		<div class="col-md-4">
			<label class="col-form-label">Rental season end</label>
			<input type="text" class="form-control" name="rental_season_end" id="rental_season_end"
			value="{{ visibleDateFormat($boat->detail->rental_season_end) }}"/>
		</div>
	</div>
	
</div>

<div class="col-md-12 py-3">
	<label class="col-form-label py-2">Share more about your vessel</label>
	<textarea class="form-control" name="private_notes" id="private_notes">{{ $boat->detail->private_notes }}</textarea>
</div>


<script type="text/javascript">
	CKEDITOR.replace( 'private_notes' );
	$( "#rental_season_start,#rental_season_end" ).datepicker({
    dateFormat: "dd-mm-yy",
    weekStart: 0,
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    rtl: true,
    orientation: "auto",
    changeMonth: true, 
    changeYear: true,
  });
</script>