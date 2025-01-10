# Contributing

> [!IMPORTANT]
> **Important Note on Major Changes**
> For substantial changes or new features that significantly alter the codebase, please discuss your proposed changes with the project maintainer or lead developer before submitting your pull request. This ensures alignment with the project's roadmap and helps avoid potential conflicts.

We appreciate your interest in contributing to this project! To ensure a smooth process, please follow these steps:

1. **Fork the repository**:

   Create your own copy of the repository on GitHub.

2. **Create a feature branch**:

   Create a new branch for each feature or bug fix with a descriptive name. This helps to keep your work organized and separate from the main codebase.

    ```bash
    $ git checkout -b feature/your-feature-name
    ```

3. **Write tests**:

    Ensure that any changes you make are covered by appropriate tests. This includes unit tests for new features and updates to existing tests where applicable.

4. **Run Tests**:

    Before submitting your changes, ensure all tests pass by running the test suite.

   ```bash
   $ composer test
   ```

5. **Follow coding standards**:

    Adhere to the project’s coding standards. We use PSR-12 coding style. You can automatically fix your code using the following commands:

   - [**PSR-12 Coding Standard**][1]
   The easiest way to apply the conventions is to install [PHP Code Sniffer][2].

   - To check for code style issues without fixing them:

      ```bash
      $ composer cs-check
      ```

   - To fix code style issues:

     ```bash
     $ composer cs-fix
     ```

    Ensure that your code is well-documented with clear comments explaining the functionality where necessary.


6. **Commit Your Changes**:

    Write clear and concise commit messages that explain your changes.

    ```bash
    $ git commit -m "Add feature X to improve Y"
    ```

7. **Push Your Branch**:

    Push your branch to your forked repository:

    ```bash
    $ git push origin feature/your-feature-name
    ```
8. **Submit a Pull Request**:

    Go to the original repository on GitHub and click "New Pull Request". Provide a clear description of the changes and why they are necessary. Link any related issues if applicable.

    > [!IMPORTANT]
    > Mention any specific tests that need to be reviewed.

We warmly welcome all contributions and are thankful for your efforts to improve this project.

**Happy coding**!

[1]: <https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-12-extended-coding-style-guide.md>
[2]: <http://pear.php.net/package/PHP_CodeSniffer>
