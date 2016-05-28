---
currentSection: v1
currentItem: home
pageflow_next_url: Interfaces/index.html
pageflow_next_text: Interfaces
---

# Version 1.x

## Introduction

Version 1 is based on the `LookUpMethodByType` feature from our original `php-reflection` library. We've retired that library, moving parts of it into [PHP: The Missing Bits](https://ganbarodigital.github.io/php-the-missing-bits/), some of it into here, and the rest into a new multi-variant [Reflection Library](https://ganbarodigital.github.io/php-mv-reflection).

## Key Ideas

The key idea in Version 1 is _type mapping_:

* Use a dispatch table to work out which method to call

## Components

Version 1 ships with the following components:

Namespace | Purpose
----------|--------
[`GanbaroDigital\Polymorphic\V1\TypeMapping`](TypeMapping/index.html) | map types onto methods

Click on the namespace to learn more about the classes in that component.
