package com.pemrogaman

data class Gitar(
    val id : Int,
    val nama : String?,
    val harga : Int?,
    val jumlah : Int?
)

val gitar: MutableList<Gitar> = mutableListOf()

fun tampilkanmenu() {
    println("menu pilihan :")
    println("1. masukkan data")
    println("2. edit data")
    println("3. list data")
    println("4. show data")
    println("5. hapus data")
    println("6. Exit")
    println("masukkan pilihan anda : ")
}

fun masukkandata() {
    println("Masukkan ID :")
    val inputId = readlnOrNull()?.toIntOrNull()
    if (inputId == null) {
        println("ID tidak boleh kosong atau bukan angka. Silakan coba lagi.")
        return
    }

    val cekid = gitar.find { it.id == inputId }

    if (cekid != null){
        println("Id $inputId sudah ada di dalam data, silahkan masukkan id yang baru")
    } else {
        println("id belum digunakan silahkan mengisi data baru,")
        println("masukkan nama :")
        val inputNama: String? = readlnOrNull()
        println("masukkan harga")
        val inputHarga: Int? = readlnOrNull()?.toIntOrNull()
        println("masukkan jumlah")
        val inputJumlah: Int? = readlnOrNull()?.toIntOrNull()

        gitar.apply {
            add(Gitar(inputId,inputNama,inputHarga,inputJumlah))
        }
    }
}

fun editdata() {
    if (gitar.isEmpty()){
        println("Belum ada data gitar, mohon masukkan terlebih dahulu")
    } else {
        println("Masukkan ID yang ingin diedit :")
        val inputId = readlnOrNull()?.toIntOrNull()

        if (inputId == null) {
            println("ID tidak boleh kosong atau bukan angka, Silakan coba lagi.")
            return
        }

        val idgitar = gitar.indexOfFirst { it.id == inputId}

        if (idgitar != -1) {
            println("Id gitar ditemukan, silahkan masukkan data baru,")
            println("masukkan nama :")
            val inputNama: String? = readlnOrNull()
            println("masukkan harga")
            val inputHarga: Int? = readlnOrNull()?.toIntOrNull()
            println("masukkan jumlah")
            val inputJumlah: Int? = readlnOrNull()?.toIntOrNull()

            val datayangada = gitar[idgitar]

            val databaru = datayangada.copy(
                nama = inputNama ?: datayangada.nama,
                harga = inputHarga ?: datayangada.harga,
                jumlah = inputJumlah ?: datayangada.jumlah
            )

            gitar[idgitar]= databaru

            println("Data berhasil diubah")
        } else {
            println("id gitar tidak ditemukan, silahkan coba lagi")
        }
    }
}

fun listdata() {
    if (gitar.isEmpty()){
        println("Belum ada data gitar, mohon masukkan terlebih dahulu")
    } else {
        println("list barang gitar :")
        gitar.forEachIndexed { _, gitar ->
            println("ID gitar : ${gitar.id}")
            println("Nama gitar : ${gitar.nama}")
            println("Harga gitar : ${gitar.harga }")
            println("umlah gitar : ${gitar.jumlah }")
        }
    }
}

fun showdata() {
    if (gitar.isEmpty()){
        println("Belum ada data gitar, mohon masukkan terlebih dahulu")
    } else {
        println("Masukkan ID gitar yang ingin dilihat datanya :")
        val inputId = readlnOrNull()?.toIntOrNull()
        if (inputId == null) {
            println("ID tidak boleh kosong atau bukan angka. Silakan coba lagi.")
            return
        }

        val cekid = gitar.find { it.id == inputId }

        if (cekid != null){
            cekid.let {
                println("ID gitar : ${it.id}")
                println("Nama gitar : ${it.nama}")
                println("Harga gitar : ${it.harga}")
                println("Jumlah gitar : ${it.jumlah}")
            }
        } else {
            println("id gitar tidak ditemukan di data")
        }
    }
}

fun hapusdata() {
    if (gitar.isEmpty()){
        println("Belum ada data gitar, mohon masukkan terlebih dahulu")
    } else {
        println("Masukkan ID gitar yang ingin dihapus:")
        val inputId = readlnOrNull()?.toIntOrNull()
        if (inputId == null) {
            println("ID tidak boleh kosong atau bukan angka. Silakan coba lagi.")
            return
        }

        val cekid = gitar.find { it.id == inputId }

        if (cekid != null){
            gitar.removeIf { it.id == inputId}
            println("data telah dihapus")
        } else {
            println("id tidak ditemukan di data")
        }
    }

}

fun main() {

    do {
        tampilkanmenu()
        val input = readlnOrNull()?.toIntOrNull()
        when (input){
            1 -> masukkandata()
            2 -> editdata()
            3 -> listdata()
            4 -> showdata()
            5 -> hapusdata()
            6 -> break
            else -> println("sepertinya anda salah masukkan angka, mohon coba lagi")
        }

    } while (true)
}