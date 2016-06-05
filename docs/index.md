---
currentSection: overview
currentItem: home
pageflow_next_url: license.html
pageflow_next_text: License
---

# Introduction

## What Is The Polymorphism Library?

Ganbaro Digital's _Polymorphism Library_ provides an easy-to-use way to add [polymorphism](https://en.wikipedia.org/wiki/Polymorphism_(computer_science)) support to your code.

This is where a class provides a method that accepts multiple data types.

## Goals

The _Polymorphism Library_'s purpose is to:

* support code that declares one interface for multiple data types (polymorphism),
* in a high-performance way

## Design Constraints

The library's design is guided by the following constraint(s):

* _Fundamental dependency of other libraries_: This library provides robustness tests for other libraries to use in production. Composer does not support multual dependencies (two or more packages depending on each other). As a result, this library needs to depend on very little (if anything at all).

## Questions?

This package was created by [Stuart Herbert](http://www.stuartherbert.com) for [Ganbaro Digital Ltd](http://ganbarodigital.com). Follow [@ganbarodigital](https://twitter.com/ganbarodigital) or [@stuherbert](https://twitter.com/stuherbert) for updates.
