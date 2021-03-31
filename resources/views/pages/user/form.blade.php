
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data User</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Nama User</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($u) ? $u->name : old("nama")}}"
                                    type="text"
                                    id="first-name-icon"
                                    class="form-control @error("name") is-invalid @enderror"
                                    name="name"
                                    placeholder="Nama Sales">
                                    <div class="form-control-position">
                                        <i class="feather icon-user"></i>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email-id-icon">Email User</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($u) ? $u->email : old("email")}}"
                                    type="email"
                                    id="email-id-icon"
                                    class="form-control @error("email") is-invalid @enderror"
                                    name="email"
                                    placeholder="Alamat Sales">
                                    <div class="form-control-position">
                                        <i class="feather icon-mail"></i>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="contact-info-icon">Level User</label>
                                <div class="position-relative has-icon-left">
                                    <select name="id_level" id="" class="form-control">
                                        <option value="#" disabled selected>Pilih Level User</option>
                                        @foreach ($level as $l)
                                            <option {{isset($u) && $l->id_level === $u->id_level ? "selected" : ""}}
                                            value="{{$l->id_level}}">{{$l->nama_level}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-position">
                                        <i class="feather icon-smartphone"></i>
                                    </div>
                                    @error('id_level')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            @if (!isset($u))
                                <div class="form-group">
                                    <label for="email-id-icon">Password</label>
                                    <div class="position-relative has-icon-left">
                                        <input
                                        type="password"
                                        id="email-id-icon"
                                        class="form-control @error("password") is-invalid @enderror"
                                        name="password"
                                        placeholder="Alamat Sales">
                                        <div class="form-control-position">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
