What you need to do

The old app-password values in accounts.csv are dead. For each of the 3 accounts (radu@blueline.md, bludelego@gmail.com, seriiburduja@gmail.com):

1. Go to https://id.atlassian.com/manage-profile/security/api-tokens → "Create API token with scopes"
2. Pick app Bitbucket, set an expiry, and grant scopes: repository:read, repository:write, repository:admin, plus account/workspace:read (for listing workspaces)
3. Replace the value in the api_token column of accounts.csv with the new token

The Basic Auth username is now your account email (already in the email column), not the Bitbucket username column — that column is still kept for reference but is no longer used for API auth.

Sources:

- Using API tokens | Bitbucket Cloud (https://support.atlassian.com/bitbucket-cloud/docs/using-api-tokens/)
- API token permissions | Bitbucket Cloud (https://support.atlassian.com/bitbucket-cloud/docs/api-token-permissions/)
- Bitbucket Cloud app password brownout schedule (https://community.atlassian.com/forums/Bitbucket-articles/Deprecation-notice-Bitbucket-Cloud-app-password-brownout/ba-p/3237429)
