<?php

namespace IparapheurV5Client\Model;

class User
{
    public string $id;
    public string $userName;
    public string $email;
    public string $firstName;
    public string $lastName;
    public string $notificationsRedirectionMail;
    public string $notificationsCronFrequency;
    public string $complementaryField;
    public string $signatureImageContentId;
    public string $privilege;
    /** @var TenantRepresentation[] */
    public array $administeredTenants;
    /** @var DeskRepresentation[] */
    public array $administeredDesks;
    /** @var DeskRepresentation[] */
    public array $supervisedDesks;
    public bool $isChecked;
    public bool $isLocked;
    public bool $isLdapSynchronized;
    public int $rolesCount;
    public bool $notifiedOnConfidentialFolders;
    public bool $notifiedOnFollowedFolders;
    public bool $notifiedOnLateFolders;
}
