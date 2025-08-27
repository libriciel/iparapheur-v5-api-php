# Local Development Guide

This file explains how to set up and run the project locally.

---

## Installation

1. Create a .env file at the root of the project with the following content:

KEYCLOAK_USERNAME=
KEYCLOAK_PASSWORD=
KEYCLOAK_CLIENT_ID=ipcore-web
KEYCLOAK_URL=https://iparapheur-5-2.partenaire.libriciel.fr/auth/realms/api/protocol/openid-connect/token
IPARAPHEUR_URL=https://iparapheur-5-2.partenaire.libriciel.fr

2. Install PHP dependencies:

make install

---

## Example commands

List tenants:

make list-tenants

---

Create a folder:

You can use the fixtures provided in the `fixtures` directory to create a folder with documents.

make create-folder tenant=<TENANT_ID> desk=<DESK_ID> folder=fixtures/folder-premis.xml documents=fixtures/test.pdf

---

Download a folder as ZIP:

make download-folder-zip tenant=<TENANT_ID> desk=<DESK_ID> folder=<FOLDER_ID>

The file will be downloaded to downloads
