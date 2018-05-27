# api

## endpoints

| Endpoint | Description | Params | Returns |
| - | - | -| - |
| /auth | Checks credentials | `email`, `password` | `jwt` |
| /contacts | Retrieves buddies | `jwt` | Contacts |
| /search | Looks for buddies | `keywords` | Contacts |
| /request | Asks contact to be buddy using their `uuid` | `from`, `to` | Status |
| /request/accept | Become buddies by sending `uuids` | `from`, `to` | Status |
