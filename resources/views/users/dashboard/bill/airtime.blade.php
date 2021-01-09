
<div class="row">
    <input type="hidden" name="biller_name" value="AIRTIME">
    <input type="hidden" name="biller_code" value="{{ $packages[0]->biller_code }}">
    <input type="hidden" name="item_code" value="{{ $packages[0]->item_code }}">
    <input type="hidden" name="parent_category" value="airtime">
    <div class="col-12 col-md-6">
        <div class="form-group float-label active">
            <input type="number" class="form-control" required="" value="" name="amount" >
            <label class="form-control-label">Amount</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group float-label active mb-0">
            <input type="tel" class="form-control" name="customer" required="" value="">
            <label class="form-control-label">Phone Number</label>
        </div>
    </div>
</div>