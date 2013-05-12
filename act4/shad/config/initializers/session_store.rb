# Be sure to restart your server when you modify this file.

# Your secret key for verifying cookie session data integrity.
# If you change this key, all old sessions will become invalid!
# Make sure the secret is at least 30 characters and all random, 
# no regular words or you'll be exposed to dictionary attacks.
ActionController::Base.session = {
  :key         => '_shad_session',
  :secret      => '23db75d4e7435edb597746709835e852e528b4c339ef3097d10563a863685a629fd3a55a1e4545dafda5bd2b2ccf1269d5e757660a1a893d6ff7d0d2ba62be8d'
}

# Use the database for sessions instead of the cookie-based default,
# which shouldn't be used to store highly confidential information
# (create the session table with "rake db:sessions:create")
# ActionController::Base.session_store = :active_record_store
