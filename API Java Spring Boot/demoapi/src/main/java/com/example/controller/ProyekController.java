package com.example.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.model.entity.Lokasi;
import com.example.model.entity.Proyek;
import com.example.service.LokasiService;
import com.example.service.ProyekService;

@RestController
@RequestMapping("/proyek")
public class ProyekController {

    @Autowired
    private LokasiService lokasiService;

    @Autowired
    private ProyekService proyekService;

    @PostMapping
    public Proyek create(@RequestBody Proyek proyek) {
        return proyekService.create(proyek);
    }

    @GetMapping
    public Iterable<Proyek> findAll() {
        return proyekService.findAll();
    }

    @GetMapping("/{id}")
    public Proyek findById(@PathVariable Integer id) {
        return proyekService.findOne(id);
    }

    @PutMapping("/{id}")
    public Proyek update(@PathVariable Integer id, @RequestBody Proyek proyek) {
        Proyek existingProyek = proyekService.findOne(id);
        if (existingProyek != null) {
            existingProyek.setNamaProyek(proyek.getNamaProyek());
            existingProyek.setClient(proyek.getClient());
            existingProyek.setTglMulai(proyek.getTglMulai());
            existingProyek.setTglSelesai(proyek.getTglSelesai());
            existingProyek.setPimpinanProyek(proyek.getPimpinanProyek());
            existingProyek.setKeterangan(proyek.getKeterangan());
            // Muat objek Lokasi baru berdasarkan idLokasi dari request
            Lokasi newLokasi = lokasiService.findOne(proyek.getIdLokasi());
            if (newLokasi != null) {
                existingProyek.setLokasi(newLokasi); // Set Lokasi dengan objek yang baru dimuat
            } else {
                throw new IllegalArgumentException("Invalid idLokasi: " + proyek.getIdLokasi());
            }
            existingProyek.setIdLokasi(proyek.getIdLokasi());

            return proyekService.create(existingProyek); // Save the updated proyek
        } else {
            return null;
        }
    }

    @DeleteMapping("/{id}")
    public void delete(@PathVariable Integer id) {
        proyekService.removeOne(id);
    }
}
