<div class="row">
    <input name="biller_code" type="hidden">
    <div class="col-12 col-md-6">
        <div class="form-group float-label active">
            <select class="form-control form-control-lg text-center" name="biller_name" id="biller_name">
                <option selected="" disabled="">Select A Package</option>
                @foreach($packages as $package)
                    <option value="{{ $package->biller_name }}" data-biller_code="{{ $package->biller_code }}" data-amount="{{ $package->amount }}" data-item_code="{{ $package->item_code }}">{{ $package->biller_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group float-label active">
            <input type="number" class="form-control" required="" value="" name="amount" readonly="">
            <label class="form-control-label">Amount</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group float-label active mb-0">
            <input type="tel" class="form-control" name="customer" required="" value="">
            <label class="form-control-label">Smart Card Number</label>
        </div>
    </div>
</div>