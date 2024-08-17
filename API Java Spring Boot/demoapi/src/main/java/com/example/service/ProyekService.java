package com.example.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.model.entity.Proyek;
import com.example.model.repository.ProyekRepository;

import jakarta.transaction.Transactional;

@Service
@Transactional
public class ProyekService {

    @Autowired
    private ProyekRepository proyekRepository;

    public Proyek create(Proyek proyek) {
        return proyekRepository.save(proyek);
    }

    public Proyek findOne(Integer id) {
        return proyekRepository.findById(id).get();
    }

    public Iterable<Proyek> findAll() {
        return proyekRepository.findAll();
    }

    public void removeOne(Integer id) {
        proyekRepository.deleteById(id);
    }

}
