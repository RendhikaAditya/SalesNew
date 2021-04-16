
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Sales</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Nama Sales</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($data) ? $data->nama_sales : old("nama_sales")}}"
                                    type="text"
                                    id="first-name-icon"
                                    class="form-control @error("nama_sales") is-invalid @enderror"
                                    name="nama_sales"
                                    placeholder="Nama Sales">
                                    <div class="form-control-position">
                                        <i class="feather icon-user"></i>
                                    </div>
                                    @error('nama_sales')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email-id-icon">Alamat Sales</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($data) ? $data->alamat_sales : old("alamat_sales")}}"
                                    type="text"
                                    id="email-id-icon"
                                    class="form-control @error("alamat_sales") is-invalid @enderror"
                                    name="alamat_sales"
                                    placeholder="Alamat Sales">
                                    <div class="form-control-position">
                                        <i class="feather icon-mail"></i>
                                    </div>
                                    @error('alamat_sales')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="contact-info-icon">No.Telpon Sales</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($data) ? $data->nohp : ""}}"
                                    type="number" name="nohp" class="form-control @error("nohp") is-invalid @enderror"
                                    placeholder="No.Telpon Sales" required>
                                    <div class="form-control-position">
                                        <i class="feather icon-smartphone"></i>
                                    </div>
                                    @error('nohp')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password-icon">Jenis Kelamin</label>
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" name="gender_sales">
                                        <option value="#" disabled selected>Pilih Gender Sales</option>
                                        <option
                                        {{isset($data) && $data->gender_sales === "Laki - Laki" ? "selected" :""}}
                                        value="Laki - Laki">
                                        Laki - Laki
                                        </option>
                                        <option
                                        {{isset($data) && $data->gender_sales === "Perempuan" ? "selected" :""}}
                                        value="Perempuan">Perempuan</option>
                                    </select>
                                    <div class="form-control-position">
                                        <i class="feather icon-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="contact-info-icon">Username</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($data) ? $data->username : old("username") }}"
                                    type="text"
                                    id="contact-info-icon"
                                    class="form-control @error("username") is-invalid @enderror"
                                    name="username"
                                    placeholder="Username">
                                    <div class="form-control-position">
                                        <i class="feather icon-user"></i>
                                    </div>
                                    @error('username')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if (!isset($data))
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-info-icon">Password</label>
                                    <div class="position-relative has-icon-left">
                                        <input
                                        type="password" id="contact-info-icon"
                                        class="form-control @error("password") is-invalid @enderror"
                                        name="password"
                                        placeholder="Password">
                                        <div class="form-control-position">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <select class="form-control js-example-basic-single" name="id_provinsi">
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    <option value="{{$prov->id}}">{{$prov->provinsi}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Kabupaten / Kota</label>
                                <select class="form-control js-example-basic-multiple" name="id_kota[]" multiple="multiple">
                                    @foreach ($kota as $no => $k)
                                    @isset($id_kota)
                                        <option
                                        {{array_search("$k->id", $id_kota) !== false ? "selected" : ""}}
                                        value="{{$k->id}}">{{$k->kabupaten_kota}}</option>
                                    @else
                                        <option value="{{$k->id}}">{{$k->kabupaten_kota}}</option>
                                    @endisset
                                    @endforeach
                                  </select>
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
