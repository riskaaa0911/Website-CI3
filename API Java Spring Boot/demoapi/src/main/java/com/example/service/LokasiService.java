package com.example.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.model.entity.Lokasi;
import com.example.model.repository.LokasiRepository;

import jakarta.transaction.Transactional;

@Service
@Transactional
public class LokasiService {

    @Autowired
    private LokasiRepository lokasiRepository;

    public Lokasi create(Lokasi lokasi) {
        return lokasiRepository.save(lokasi);
    }

    public Lokasi findOne(Integer id) {
        return lokasiRepository.findById(id).get();
    }

    public Iterable<Lokasi> findAll() {
        return lokasiRepository.findAll();
    }

    public void removeOne(Integer id) {
        lokasiRepository.deleteById(id);
    }

}