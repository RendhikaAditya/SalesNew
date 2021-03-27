
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
                                    value="{{isset($k) ? $k->nama_kategori : old("nama_kategori")}}"
                                    type="text"
                                    id="email-id-icon"
                                    class="form-control @error("nama_kategori") is-invalid @enderror"
                                    name="nama_kategori"
                                    placeholder="Nama Kategori">
                                    <div class="form-control-position">
                                        <i class="feather icon-list"></i>
                                    </div>
                                    @error('nama_kategori')
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
