<!--
#Laravel Command Line Validation

This is a package to validate your custom laravel commands. 
With this package you can use the same rule logic as with normal validation forms. 
We tried to integrate the project as well as possible into the laravel ecosystem.


In laravel you can easily validate user data in forms. 
But there wasn't a standard solution if you want to validate something else without forms. 
We want change that and want to offer a simple solution. 


##Getting Started

Require this package with composer.

###Prerequisites
php version

###Installing

###Usage


##Diagrams
##Acknowledgments
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).






Configuring Bash Alias Sail:
without: ./vendor/bin/sail up

alias sail='bash vendor/bin/sail'
sail up

usage
sail php artisan user:create -e ojdaj@gmail.com

best command use without =  (= is displayed by -b=a and space works with both options)

    //{email} == required
    //{--first_name=} == optional & default value NULL
    //--f| == shortcut can be used with: -f name
only use options no arguments

help:
sail php artisan user:create --help

-->






<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/github_username/repo_name">
    <img src="https://img.pngio.com/validate-interface-searching-icon-png-and-vector-for-free-validate-png-512_511.png" alt="Logo" width="80" height="80">
  </a>

<h2 align="center">Laravel Command Line Validation </h2>

<p align="center">
    This is a package to validate your custom laravel commands.
</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary><h2 style="display: inline-block">Table of Contents</h2></summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#class-diagram">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgements">Acknowledgements</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

This is a package to validate your custom laravel commands.
With this package you can use the same rule logic as with the normal validation forms.
We tried to integrate the project as well as possible into the laravel ecosystem.


In laravel you can easily validate user data in forms.
But there wasn't a standard solution if you want to validate something else without forms.
We want change that and want to offer a simple solution.


### Built With

* [php 7.3]()
* [laravel 8]()
* []()



<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

This is an example of how to list things you need to use the software and how to install them.
* composer
  ```sh
  composer install
  ```

### Installation

1. Go to your project folder in your favorite command line interface

2. Install Composer packages
   ```sh
   composer require wtl/laravelCommandLineValidation
   ```



<!-- USAGE EXAMPLES -->
## Usage

Use this space to show useful examples of how a project can be used. Additional screenshots, code examples and demos work well in this space. You may also link to more resources.

_For more examples, please refer to the [Documentation](https://example.com)_



<!-- CLASS DIAGRAM -->
## Class Diagram

Diagram



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.



<!-- CONTACT -->
## Contact

E-mail:

<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements

* [nice Readme](https://github.com/othneildrew/Best-README-Template/blob/master/BLANK_README.md)
* []()
* []()





<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/github_username/repo.svg?style=for-the-badge
[contributors-url]: https://github.com/github_username/repo/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/github_username/repo.svg?style=for-the-badge
[forks-url]: https://github.com/github_username/repo/network/members
[stars-shield]: https://img.shields.io/github/stars/github_username/repo.svg?style=for-the-badge
[stars-url]: https://github.com/github_username/repo/stargazers
[issues-shield]: https://img.shields.io/github/issues/github_username/repo.svg?style=for-the-badge
[issues-url]: https://github.com/github_username/repo/issues
[license-shield]: https://img.shields.io/github/license/github_username/repo.svg?style=for-the-badge
[license-url]: https://github.com/github_username/repo/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/github_username

## This is the introduction <a name="introduction"></a>
Some introduction text, formatted in heading 2 style

create laravel command
php artisan make:command SendEmails
