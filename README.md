# Welcome to the Open Source Blog Community Portal template!
![image](https://user-images.githubusercontent.com/84431594/210421046-955c4670-9da3-4af4-99e3-b4ad198ae2cc.png)

This is a platform for writers to share their blog posts and for readers to discover new and interesting content. The portal is completely open source, meaning that anyone can contribute to the development and improvement of the platform.
## Features

- Create a profile to share your blog posts and connect with other writers
- Follow other users to stay up-to-date on their latest blog posts
- Discover new content through the explore page and search function
- Leave comments and engage with other writers
- Share your blog posts on social media
## Requirements

The following tools are required in order to start the installation.

- PHP 8.1
- [Composer](https://getcomposer.org/download/)
- [NPM](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

## Installation

To get started, clone this repository and install the dependencies:

```bash
git clone https://github.com/[USERNAME]/blog.git
cd blog
composer install
cp .env.example .env
php artisan key:generate
```

## Usage

To start the development server:

```bash
php artisan serve 
```
To Asset Bundling
```bash
npm install
npm run dev
```

The app will be served at http://localhost:8000/.
## Contributing

Please read [the contributing guide](CONTRIBUTING.md) before creating an issue or sending in a pull request.
## Code of Conduct

Please read our [Code of Conduct](CODE_OF_CONDUCT.md) before contributing or engaging in discussions.
## License

This project is licensed under the BSD-3-Clause license  - see [the license file](LICENSE.md) for details.
