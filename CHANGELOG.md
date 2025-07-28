# [0.3.0] - 2025-07-25

## Changement

- Mise à jour vers la version 5.1.22 de l'API iParapheur.
- Utilisation de la librairie autogénérée https://openapi-generator.tech/docs/generators/php

## Remplacement de classes et méthodes

Les anciennes classes ont été remplacées par des classes *Api. Voici les correspondances :

### AdminTrashBin
- AdminTrashBin::listTrashBinFolders → AdminTrashBinApi::listTrashBinFolders
- AdminTrashBin::downloadTrashBinFolderZip → AdminTrashBinApi::downloadTrashBinFolderZip
- AdminTrashBin::deleteTrashBinFolder → AdminTrashBinApi::deleteTrashBinFolder

### Desk
- Desk::listUserDesks → DeskApi::listUserDesks

### Folder
- Folder::createFolder → FolderApi::createFolder
- Folder::listFolders → FolderApi::listFolders
- Folder::downloadFolderZip → FolderApi::downloadFolderZip
- Folder::downloadFolderPremis → FolderApi::downloadFolderPremis
- Folder::deleteFolder → FolderApi::deleteFolder

### Tenant
- Tenant::listTenants → TenantApi::listTenants

### Typology
- Typology::listTypes → TypologyApi::listTypes
- Typology::listSubtypes → TypologyApi::listSubtypes
- Typology::listCreationAllowedTypes → TypologyApi::listCreationAllowedTypes
- Typology::listCreationAllowedSubtypes → TypologyApi::listCreationAllowedSubtypes

### Workflow
- Workflow::undo → WorkflowApi::undo
- Workflow::start → WorkflowApi::start
- Workflow::sendToTrashBin → WorkflowApi::sendToTrashBin

### SecureMail
- Workflow::requestSecureMail → SecureMailApi::requestSecureMail


# [0.2.0] - 2023-12-18

- Utilisation de l'API iparapheur en version 5.0.20

# [0.1.0] - 2023-01-03

## Ajout

- Génération des fonctions GET, POST et DELETE