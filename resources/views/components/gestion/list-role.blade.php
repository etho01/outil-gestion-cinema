<div class="">
    <x-layout.sub-title title="Roles" />
    <div class="d-flex row p-5">
        @foreach ($roles as $role)
            <div class="col-12 col-sm-6 col-lg-4 p-2">
                <x-input.checkbox :nom="$role->nom" :id="$role->id" enable="{{ in_array($role->id, $listRoleEnable) }}" prefix="role_"/>
            </div>
        @endforeach
    </div>
</div>