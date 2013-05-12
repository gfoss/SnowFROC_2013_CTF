# Be sure to restart your server when you modify this file.

# Your secret key for verifying cookie session data integrity.
# If you change this key, all old sessions will become invalid!
# Make sure the secret is at least 30 characters and all random, 
# no regular words or you'll be exposed to dictionary attacks.
ActionController::Base.session = {
  :key         => '_shadowcorp_session',
  :secret      => '3f403b3faf62709e8b14d72e524981f4ed98b6f8897dbafe2de1366362a8bf122443e0747ad8ace6ed5a67e2b1ecde4f427840eccb62b6c8da0f42571a65ca58'
}

# Use the database for sessions instead of the cookie-based default,
# which shouldn't be used to store highly confidential information
# (create the session table with "rake db:sessions:create")
# ActionController::Base.session_store = :active_record_store
