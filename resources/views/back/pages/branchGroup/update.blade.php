<x-back.master>




    <form action="{{ route('admin.branchGroup.update') }}" method="POST">
        @csrf
        <div class="tab-content" id="myTabContent">
                    <div class="mb-4">
                        <label class="form-label">Grup Adı:</label>
                        <input type="text" name="name"  value="{{ $edit->name }}" class="form-control" placeholder="Grup Adı">
                        <input type="hidden" name="id" value="{{ $edit->id }}">
                    </div>
        </div>
        <div class="row">
            <button  type="submit" class="btn btn-success me-2 mb-2">
                Güncelle
            </button>
        </div>

    </form>

</x-back.master>




