
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Costumer</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email-id-icon">Nama Costumer</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($c) ? $c->nama_costumer : old("nama_costumer")}}"
                                    type="text"
                                    id="email-id-icon"
                                    class="form-control @error("nama_costumer") is-invalid @enderror"
                                    name="nama_costumer"
                                    placeholder="Nama Kategori">
                                    <div class="form-control-position">
                                        <i class="feather icon-user"></i>
                                    </div>
                                    @error('nama_costumer')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email-id-icon">Alamat Customer</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($c) ? $c->alamat_costumer : old("alamat_costumer")}}"
                                    type="text"
                                    id="email-id-icon"
                                    class="form-control @error("alamat_costumer") is-invalid @enderror"
                                    name="alamat_costumer"
                                    placeholder="Nama Kategori">
                                    <div class="form-control-position">
                                        <i class="feather icon-list"></i>
                                    </div>
                                    @error('alamat_costumer')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email-id-icon">Target Harga Costumer</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($c) ? number_format($c->targer_harga_costumer) : old("targer_harga_costumer")}}"
                                    type="text"
                                    id="target_harga"
                                    class="form-control @error("targer_harga_costumer") is-invalid @enderror"
                                    name="targer_harga_costumer"
                                    onkeydown="currency(this)"
                                    placeholder="Target Harga Costumer">
                                    <div class="form-control-position">
                                        <i class="feather icon-list"></i>
                                    </div>
                                    @error('targer_harga_costumer')
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
