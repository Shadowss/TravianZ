#!/usr/bin/env bash

set -euo pipefail

repository_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$repository_root"

lint_php()
{
	local file
	local linted=0

	while IFS= read -r -d '' file; do
		# This installer source is a PHP generator template. Its %TOKEN%
		# placeholders are replaced before the generated file is executed.
		if [[ "$file" == "install/data/constant_format.tpl" ]]; then
			continue
		fi

		php -l "$file" > /dev/null
		linted=$((linted + 1))
	done < <(git ls-files -z -- '*.php' '*.tpl')

	echo "PHP syntax check passed for ${linted} tracked files."
}

run_php_tests()
{
	local file
	local tested=0

	while IFS= read -r -d '' file; do
		if [[ "$file" != *Test.php ]]; then
			continue
		fi

		echo "Running ${file}"
		php "$file"
		tested=$((tested + 1))
	done < <(git ls-files -z -- 'tests/*.php' 'tests/**/*.php')

	if [[ "$tested" -eq 0 ]]; then
		echo "No zero-dependency PHP tests found."
	else
		echo "PHP tests passed for ${tested} files."
	fi
}

run_shell_tests()
{
	local file
	local tested=0

	while IFS= read -r -d '' file; do
		if [[ "$file" != *.sh ]]; then
			continue
		fi

		echo "Running ${file}"
		sh -n "$file"
		sh "$file"
		tested=$((tested + 1))
	done < <(git ls-files -z -- 'tests/*.sh' 'tests/**/*.sh')

	if [[ "$tested" -eq 0 ]]; then
		echo "No shell contract tests found."
	else
		echo "Shell contract tests passed for ${tested} files."
	fi
}

validate_compose()
{
	if ! command -v docker > /dev/null 2>&1; then
		echo "Docker is required for Compose validation." >&2
		exit 1
	fi

	docker compose config --quiet
	echo "Docker Compose configuration is valid."
}

usage()
{
	echo "Usage: $0 {all|php|lint|test|shell|compose}" >&2
	exit 2
}

case "${1:-all}" in
	all)
		lint_php
		run_php_tests
		validate_compose
		run_shell_tests
		;;
	php)
		lint_php
		run_php_tests
		;;
	lint)
		lint_php
		;;
	test)
		run_php_tests
		run_shell_tests
		;;
	shell)
		run_shell_tests
		;;
	compose)
		validate_compose
		;;
	*)
		usage
		;;
esac
