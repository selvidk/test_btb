<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-2">
                {{ __('Request Ruang Rapat') }}
            </h2>
            <button data-modal-target="add-modal" data-modal-toggle="add-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                </svg>
            </button>
            
        </div>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Request
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Rapat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Waktu Rapat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Divisi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $d)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                           {{ $no++ }} 
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $d->tanggal_request }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $d->tanggal_rapat }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $d->waktu_mulai }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $d->divisi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                switch ($d->status_verifikasi) {
                                                    case 0:
                                                        $status = "Proses";
                                                        break;
                                                    case 1:
                                                        $status = "Disetujui";
                                                        break;
                                                    case 2:
                                                        $status = "Tidak Disetujui";
                                                        break;
                                                    // case '2':
                                                    //     $status = "Tidak Disetujui";
                                                    //     break;
                                                    // default:
                                                    //     $status = "Tidak Diketahui"
                                                }
                                            @endphp
                                            {{ $status }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- @if (auth()->user()->role() == 0) --}}
                                                @if ($d->status_verifikasi == 0)
                                                <button type="button" data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                                                @endif
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                    <div id="edit-modal" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Verifikasi Permintaan
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="edit-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <form method="post" id="editForm" action="{{ route('request.verifikasi') }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $d->id }}">
                                                        <div class="mb-5">
                                                            <label for="nama_ruang"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Divisi</label>
                                                            <span type="nama_ruang" id="nama_ruang"
                                                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                >{{ $d->divisi }}</span>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan Rapat</label>
                                                            <span type="nama_ruang" id="nama_ruang"
                                                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{
                                                                $d->deskripsi_rapat }}</span>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Request Ruang</label>
                                                            <span type="nama_ruang" id="nama_ruang"
                                                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{
                                                                $d->ruang }}</span>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Rapat</label>
                                                            <span type="nama_ruang" id="nama_ruang"
                                                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{
                                                                $d->tanggal_rapat }}</span>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Rapat</label>
                                                            <span type="nama_ruang" id="nama_ruang"
                                                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{
                                                                $d->waktu_mulai }} - {{ $d->waktu_selesai }}</span>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="password"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                                            <select id="status_verifikasi" name="status_verifikasi"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                <option selected>Pilih Status</option>
                                                                <option value="1">Disetujui</option>
                                                                <option value="2">Tidak Disetujui</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
                                                            <input id="keterangan_verifikasi" name="keterangan_verifikasi"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <button data-modal-hide="edit-modal" type="submit" form="editForm"
                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        Simpan</button>
                                                    <button data-modal-hide="edit-modal" type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Main modal -->
                <div id="add-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Request Ruang
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="add-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <form method="post" id="addForm" action="{{ route('request.add') }}">
                                    @csrf
                                    <div class="mb-5">
                                        <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Ruang</label>
                                        <select id="nama_ruang" name="nama_ruang"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih Ruang</option>
                                            @foreach ($ruang as $r)
                                                <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan
                                            Rapat</label>
                                        <input type="text" id="deskripsi_rapat" name="deskripsi_rapat"
                                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="mb-5">
                                        <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Rapat</label>
                                        <input type="date" id="tanggal_rapat" name="tanggal_rapat"
                                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="mb-5">
                                        <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Mulai</label>
                                        <input type="time" id="waktu_mulai" name="waktu_mulai"
                                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="mb-5">
                                        <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Selesai</label>
                                        <input type="time" id="waktu_selesai" name="waktu_selesai"
                                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="add-modal" type="submit" form="addForm"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                    Simpan</button>
                                <button data-modal-hide="add-modal" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>