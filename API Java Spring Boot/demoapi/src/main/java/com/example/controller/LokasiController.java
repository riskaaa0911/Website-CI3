package com.example.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseStatus;
import org.springframework.web.bind.annotation.RestController;

import com.example.model.entity.Lokasi;
import com.example.service.LokasiService;

@RestController
@RequestMapping("/lokasi")
public class LokasiController {

    @Autowired
    private LokasiService lokasiService;

    @PostMapping
    public Lokasi create(@RequestBody Lokasi lokasi) {
        return lokasiService.create(lokasi);
    }

    @GetMapping
    public Iterable<Lokasi> findAll() {
        return lokasiService.findAll();
    }

    @PutMapping("/{id}")
    public Lokasi update(@PathVariable Integer id, @RequestBody Lokasi lokasi) {
        Lokasi existingLokasi = lokasiService.findOne(id);
        if (existingLokasi != null) {
            existingLokasi.setNamaLokasi(lokasi.getNamaLokasi());
            existingLokasi.setNegara(lokasi.getNegara());
            existingLokasi.setProvinsi(lokasi.getProvinsi());
            existingLokasi.setKota(lokasi.getKota());
            return lokasiService.create(existingLokasi); // Save the updated lokasi
        } else {
            return null;
        }
    }

    @DeleteMapping("/{id}")
    @ResponseStatus(HttpStatus.NO_CONTENT)
    public void delete(@PathVariable Integer id) {
        lokasiService.removeOne(id);
    }

    @GetMapping("/{id}")
    public Lokasi findById(@PathVariable Integer id) {
        return lokasiService.findOne(id);
    }

}
