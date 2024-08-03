<template>
    <div class="p-8">
      <!-- <Spinner v-if="loading" class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center" /> -->
      <h1 class="text-xl font-semibold mb-4">Upload Produk</h1>
      <div>
        <!-- Tombol Download Template Excel -->
        <button @click="downloadTemplate" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Download Template Excel
        </button>
      </div>
      <div class="my-4">
        <!-- Input untuk Upload File Excel -->
        <input type="file" @change="handleFileUpload" accept=".xlsx"/>
      </div>
      <!-- Tampilkan data yang diupload dalam bentuk tabel -->
      <div v-if="uploadedData.length > 0">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Jenis
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Kode Produk
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Judul Produk
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Gambar Produk
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Deskripsi Produk
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Harga Eceran
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Max Kuantitas Eceran
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Harga Grosir
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Unit
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Material
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Berat
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Satuan Berat
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Isi Per Kotak
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Satuan Per Box
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Grade
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Thread Direction
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Thread Density
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Diameter
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Diameter Dalam
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Diameter Luar
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Satuan Diameter
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Panjang
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Satuan Panjang
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Tebal Kepala
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Satuan Tebal Kepala
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Panjang drat (b)
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Satuan Panjang drat
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Warna
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Tipe drat
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Ukuran Drat
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Dimensional Standart
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Head Style
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Drive Type
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Kunci Kepala
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Published
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="(data, index) in uploadedData" :key="index">
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.type }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.code }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.title }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <!-- {{ data.image }} -->
                <img :src="data.image" alt="Gambar Produk" class="w-20 h-20 object-cover"/>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.description }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.price_retail }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.quantity_limit }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.price_wholesale }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.unit }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.material }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.weight }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.weight_unit }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.contents_per_box }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.contents_per_box_unit }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.grade }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.thread_direction }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.thread_density }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.diameter }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.inner_diameter }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.outer_diameter }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.diameter_unit }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.length }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.length_unit }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.thick_head }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.thick_head_unit }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.drat_length }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.drat_length_unit }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.color }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.drat_type }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.drat_size }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.dimensional_standart }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.head_style }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.drive_type }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.across_flats }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ data.published }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <button v-if="uploadedData.length > 0" @click="saveData" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Simpan
      </button>
    </div>
  </template>
  
<script setup>
  import { ref } from 'vue';
  import * as XLSX from 'xlsx';
  import store from '../../store';
  
  const uploadedData = ref([]);
  
  // const loading = ref(false)

  function downloadTemplate() {
    // Membuat workbook dan worksheet
    const wb = XLSX.utils.book_new();
    const ws_data = [
        [
          "type", 
          "code", 
          "title", 
          "description", 
          "price_retail",
          "quantity_limit",
          "price_wholesale",
          "unit",
          "material",
          "weight",
          "weight_unit",
          "contents_per_box",
          "contents_per_box_unit",
          "grade",
          "thread_direction",
          "thread_density",
          "diameter",
          "inner_diameter",
          "outer_diameter",
          "diameter_unit",
          "length",
          "length_unit",
          "thick_head",
          "thick_head_unit",
          "drat_length",
          "drat_length_unit",
          "color",
          "drat_type",
          "drat_size",
          "dimensional_standart",
          "head_style",
          "drive_type",
          "across_flats",
          "published",

        ], // Header row
        [
          "1", // "type",
          "1", // "code",
          "Product Title", // "title",
          "Description here", // "description",
          "50000", // "price_retail",
          "10", // "quantity_limit",
          "45000", // "price_wholesale",
          "2", // "unit",
          "3", // "material",
          "1.5", // "weight",
          "2", // "weight_unit",
          "50", // "contents_per_box",
          "4", // "contents_per_box_unit",
          "10", // "grade",
          "2", // "thread_direction",
          "2", // "thread_density",
          "3", // "diameter",
          "1.5", // "inner_diameter",
          "2", // "outer_diameter",
          "50", // "diameter_unit",
          "4",// "length",
          "4", // "length_unit",
          "10", // "thick_head",
          "45000", // "thick_head_unit",
          "2", // "drat_length",
          "3", // "drat_length_unit",
          "1", // "color",
          "2", // "drat_type",
          "50", // "drat_size",
          "4", // "dimensional_standart",
          "4", // "head_style",
          "4", // "drive_type",
          "4", // "across_flats",
          "1"// "published",
        ],
    ];
    const ws = XLSX.utils.aoa_to_sheet(ws_data);

    // Menambahkan style untuk header
    const headerRange = XLSX.utils.decode_range(ws['!ref']); // Dapatkan range dari sheet
    for(let C = headerRange.s.c; C <= headerRange.e.c; ++C) {
        const address = XLSX.utils.encode_col(C) + "1"; // Target kolom header (baris 1)
        if(!ws[address]) continue; // Jika sel tidak ditemukan, lewati
        ws[address].s = {
        fill: {
            fgColor: { rgb: "FFFF00" } // Memberikan warna kuning pada header
        },
        font: {
            bold: true, // Membuat font menjadi tebal
        },
        alignment: {
            horizontal: "center", // Posisi teks di tengah secara horizontal
            vertical: "center", // Posisi teks di tengah secara vertikal
        },
        border: {
            top: { style: "thin", color: { auto: 1 } },
            right: { style: "thin", color: { auto: 1 } },
            bottom: { style: "thin", color: { auto: 1 } },
            left: { style: "thin", color: { auto: 1 } }
        }
        };
    }

    // Setting lebar kolom secara manual (opsional)
    ws['!cols'] = [{wch:20}, {wch:20}, {wch:30}, {wch:30}];

    // Menambahkan worksheet ke workbook
    XLSX.utils.book_append_sheet(wb, ws, 'Template');

    // Menyimpan workbook sebagai file Excel
    XLSX.writeFile(wb, 'template_produk.xlsx');
  }

  function handleFileUpload(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
      const data = new Uint8Array(e.target.result);
      const workbook = XLSX.read(data, {type: 'array'});
      const sheetName = workbook.SheetNames[0];
      const worksheet = workbook.Sheets[sheetName];
      // Asumsikan baris pertama adalah header dan baris kedua adalah contoh pengisian data.
      // Kita akan memulai dari baris ketiga
      let json = XLSX.utils.sheet_to_json(worksheet, {header: 1}).slice(2);

      uploadedData.value = json.map(row => {
        // Membuat objek baru dengan properti sesuai header dan tambah properti 'image'
        const rowObject = row.reduce((accumulator, currentValue, currentIndex) => {
          if (worksheet['!ref']) {
            const headerRow = worksheet['!ref'].split(':')[0].replace(/\d+/g, '');
            const cellRef = XLSX.utils.encode_cell({c: currentIndex, r: 0});
            const header = worksheet[cellRef].v;
            accumulator[header] = currentValue;
          }
          return accumulator;
        }, {});

        // Menambahkan path gambar default
        // rowObject.image = '/product_default.png';
        rowObject.image = '/product_default.png'; 
        // rowObject.image = require('@/public/product_default.png');
        return rowObject;
      });

      console.log(uploadedData.value);
    };
    reader.readAsArrayBuffer(file);
  }
  
  function saveData123() {
    console.log('Simpan data:', uploadedData.value);

    // loading.value = true

    const transformedData = uploadedData.value.map(item => ({
      // Sesuaikan dengan field yang ada di API Anda
      type: item.type,
      code: item.code,
      title: item.title,
      description: item.description,
      price_retail: item.price_retail,
      quantity_limit: item.quantity_limit,
      price_wholesale: item.price_wholesale,
      unit: item.unit,
      material: item.material,
      weight: item.weight,
      weight_unit: item.weight_unit,
      contents_per_box: item.contents_per_box,
      contents_per_box_unit: item.contents_per_box_unit,
      grade: item.grade,
      thread_direction: item.thread_direction,
      thread_density: item.thread_density,
      diameter: item.diameter,
      inner_diameter: item.inner_diameter,
      outer_diameter: item.outer_diameter,
      diameter_unit: item.diameter_unit,
      length: item.length,
      length_unit: item.length_unit,
      thick_head: item.thick_head,
      thick_head_unit: item.thick_head_unit,
      drat_length: item.drat_length,
      drat_length_unit: item.drat_length_unit,
      color: item.color,
      drat_type: item.drat_type,
      drat_size: item.drat_size,
      dimensional_standart: item.dimensional_standart,
      head_style: item.head_style,
      drive_type: item.drive_type,
      across_flats: item.across_flats,
      published: item.published,
    }));


    const validData = false;

    for (const item of transformedData) {
      store.dispatch('createProduct', item)
        .then(response => {
          if (response.status === 201) {
            validData = true;
          }
        })
        .catch(err => {
            validData = false;
            errors.value = err.response.data.errors;
        })
    }

    if (validData) {
        // TODO show notification 
        console.log('tesss');

        store.commit('showToast', 'Thread Density berhasil ditambah.');
        // store.dispatch('getThreadDensities')
        // closeModal()
    }

  }

  async function saveData() {
    // Pastikan Anda memiliki action di Vuex store yang menghandle multiple create atau update
    try {
      // Mungkin Anda perlu transformasi data terlebih dahulu
      const transformedData = uploadedData.value.map(item => ({
        // Sesuaikan dengan field yang ada di API Anda
        type_id: item.type,
        code: item.code,
        title: item.title,
        image: '',
        description: item.description,
        price_retail: item.price_retail,
        quantity_limit: item.quantity_limit,
        price_wholesale: item.price_wholesale,
        unit_id: item.unit,
        material_id: item.material,
        weight: item.weight,
        weight_unit_id: item.weight_unit,
        contents_per_box: item.contents_per_box,
        contents_per_box_unit_id: item.contents_per_box_unit,
        grade: item.grade,
        thread_direction_id: item.thread_direction,
        thread_density_id: item.thread_density,
        diameter: item.diameter,
        inner_diameter: item.inner_diameter,
        outer_diameter: item.outer_diameter,
        diameter_unit_id: item.diameter_unit,
        length: item.length,
        length_unit_id: item.length_unit,
        thick_head: item.thick_head,
        thick_head_unit_id: item.thick_head_unit,
        drat_length: item.drat_length,
        drat_length_unit_id: item.drat_length_unit,
        drat_size: item.drat_size,
        dimensional_standart: item.dimensional_standart,
        head_style: item.head_style,
        drive_type: item.drive_type,
        across_flats: item.across_flats,
        drat_type: item.drat_type,
        color_id: item.color,
        published: item.published,
      }));

      // Loop through data and save each item
      for (const item of transformedData) {
        console.log(item);
        await store.dispatch('createProduct', item);
      }

      // Show success message
      store.commit('showToast', 'Produk berhasil diupload.');

      // Optional: clear the uploaded data after saving
      uploadedData.value = [];
    } catch (error) {
      console.error('Error saving data:', error);
      // Show error message
      store.commit('showToast', 'Terjadi kesalahan saat mengupload produk.');
    }
  }
</script>
  
<style scoped>
</style>
  