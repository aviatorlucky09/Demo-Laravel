<div class="col-md-12 row pt-3">
	<label class="col-form-label h4 text-dark">What boat services you offer ?</label>
</div>   
<div class="col-md-12 row">
	<hr>
</div>

<div class="col-md-12 row py-3">
	
	<div class="col-md-6">
		<div class="col-md-12 row">
			<label class="col-form-label">Pets allowed</label>
		</div>
		<div id="same_as_marina_2" class="col-md-12 row pl-2 d-fex justify-content-around">
			<div class="col-md-2">
				<input class="form-check-input" type="radio" name="pets_allowed" 
				value="1" id="pets_allowed_1" @if($boat->detail->pets_allowed == 1) checked @endif>
				<label class="form-check-label" for="pets_allowed_1">
					Yes  
				</label>
			</div>
			<div class="col-md-2">
				<input class="form-check-input" type="radio" name="pets_allowed" 
				value="0" id="pets_allowed_0" @if($boat->detail->pets_allowed == 0) checked @endif>
				<label class="form-check-label" for="pets_allowed_0">
					No 
				</label>
			</div>
			<div class="col-md-3">
				<input class="form-check-input" type="radio" name="pets_allowed" 
				value="2" id="pets_allowed_2" @if($boat->detail->pets_allowed == 2) checked @endif>
				<label class="form-check-label" for="pets_allowed_2">
					Hide Section  
				</label>
			</div>
		</div>
		
	</div>
		<div class="col-md-6">
		<div class="col-md-12 row">
			<label class="col-form-label">Fuel included in price</label>
		</div>
		<div id="same_as_marina_3" class="col-md-12 row pl-2 d-fex justify-content-around">
			<div class="col-md-2">
				<input class="form-check-input" type="radio" name="fuel_included" 
				value="1" id="fuel_included_1" @if($boat->detail->fuel_included == 1) checked @endif>
				<label class="form-check-label" for="fuel_included_1">
					Yes  
				</label>
			</div>
			<div class="col-md-2">
				<input class="form-check-input" type="radio" name="fuel_included" 
				value="0" id="fuel_included_0" @if($boat->detail->fuel_included == 0) checked @endif>
				<label class="form-check-label" for="fuel_included_0">
					No 
				</label>
			</div>
			
		</div>
		
		<div class="clearfix"></div>
	</div>
</div>

<div class="col-md-12 row py-3">

	<div class="col-md-6">
		<div class="col-md-12 row">
			<label class="col-form-label">Captain required</label>
		</div>
		<div class="col-md-12 row pl-2 d-fex justify-content-around">
			<div class="col-md-2  form-check">
				<input class="form-check-input" type="radio" name="captains_required" 
				value="1" id="captains_required_1" @if($boat->detail->captains_required === '1') checked @endif>
				<label class="form-check-label" for="captains_required_1">
					Yes  
				</label>
			</div>
			<div class="col-md-2  form-check">
				<input class="form-check-input" type="radio" name="captains_required" 
				value="0" id="captains_required_0"  @if($boat->detail->captains_required === '0') checked @endif>
				<label class="form-check-label" for="captains_required_0">
					No  
				</label>
			</div>
			
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-12 row">
			<label class="col-form-label">Captain available upon request</label>
		</div>
		<div class="col-md-12 row pl-2 d-fex justify-content-around">
			<div class="col-md-2  form-check">
				<input class="form-check-input" type="radio" name="captains_available" 
				value="1" id="captains_available_1" @if($boat->detail->captains_available === '1') checked @endif>
				<label class="form-check-label" for="captains_available_1">
					Yes  
				</label>
			</div>
			<div class="col-md-2  form-check">
				<input class="form-check-input" type="radio" name="captains_available" 
				value="0" id="captains_available_0" @if($boat->detail->captains_available === '0') checked @endif>
				<label class="form-check-label" for="captains_available_0">
					No  
				</label>
			</div>
			
		</div>
		
	</div>
</div>

<div class="col-md-12 row py-3">
	

	<div class="col-md-6">
		<div class="col-md-12 row">
			<label class="col-form-label">Towing Allowed</label>
		</div>
		<div class="col-md-12 row pl-2 d-fex justify-content-around">
			<div class="col-md-2  form-check">
				<input class="form-check-input" type="radio" name="towing_allowed" 
				value="1" id="towing_allowed_1" @if($boat->detail->towing_allowed === '1') checked @endif>
				<label class="form-check-label" for="towing_allowed_1">
					Yes  
				</label>
			</div>
			<div class="col-md-2  form-check">
				<input class="form-check-input" type="radio" name="towing_allowed" 
				value="0" id="towing_allowed_0" @if($boat->detail->towing_allowed === '0') checked @endif>
				<label class="form-check-label" for="towing_allowed_0">
					No  
				</label>
			</div>
			
		</div>
		
	</div>
	{{-- <div class="col-md-6">
		<div class="col-md-12 row">
			<label class="col-form-label">Captain included in price?</label>
		</div>
		<div class="col-md-12 row ml-2 d-fex justify-content-start">
			<div class="col-md-3  form-check">
				<input class="form-check-input" type="radio" name="caption_required_price" 
				value="1" id="caption_required_price_1" @if($boat->detail->caption_required_price == 1) checked @endif>
				<label class="form-check-label" for="caption_required_price_1">
					Yes  
				</label>
			</div>
			<div class="col-md-3  form-check">
				<input class="form-check-input" type="radio" name="caption_required_price" 
				value="0" id="caption_required_price_0" @if($boat->detail->caption_required_price == 0) checked @endif>
				<label class="form-check-label" for="caption_required_price_0">
					No  
				</label>
			</div>
		</div>
		
	</div> --}}
</div>



