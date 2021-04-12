
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Kategori</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email-id-icon">Nama Kategori</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($b) ? $b->bentuk_pembayaran : old("bentuk_pembayaran")}}"
                                    type="text"
                                    id="email-id-icon"
                                    class="form-control @error("bentuk_pembayaran") is-invalid @enderror"
                                    name="bentuk_pembayaran"
                                    placeholder="Bentuk Pembayaran">
                                    <div class="form-control-position">
                                        <i class="feather icon-list"></i>
                                    </div>
                                    @error('bentuk_pembayaran')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
