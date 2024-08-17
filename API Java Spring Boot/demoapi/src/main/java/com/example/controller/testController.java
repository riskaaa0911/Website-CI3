package com.example.controller;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/api/testmagang")
public class testController {
    @GetMapping
    public String welcome() {
        return "Welcome to Spring Boot Rest API";
    }
}
