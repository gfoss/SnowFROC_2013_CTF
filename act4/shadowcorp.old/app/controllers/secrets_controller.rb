# Filters added to this controller apply to all controllers in the application.
# Likewise, all the methods added will be available for all controllers.

class SecretsController < ActionController::Base
  helper :all # include all helpers, all the time
  def search
    @secret = secret.find_by_secret(params[:secret])

    render :json => @secret
  end
end
